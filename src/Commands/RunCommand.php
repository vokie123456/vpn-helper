<?php
namespace Springjk\Commands;

use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunCommand extends Base
{
    protected function configure()
    {
        $this
            ->setName('run')
            ->setDescription('Ping test vpn server list and connection the fastest one');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $servers = $this->getServers($io);

        $io->section('execute ping command test servers speed');

        $io->write('run ping...');

        $this->system->pingTest($servers);

        $io->progressStart(count($servers));

        $servers = $this->system->analysisPingResult($servers, function ($message) use ($io) {
            $io->progressAdvance();

            $io->write(' ' . $message);
        });

        $io->progressFinish();

        $servers = $this->sortArray($servers, 'avg');

        $this->showTable($servers, $output);

        $fastest_vpn_connection_name = $servers[0]['name'];

        $fastest_vpn_info = 'the minimal delay line is：' . $fastest_vpn_connection_name . ' AVG: ' . $servers[0]['avg'];

        $io->block($fastest_vpn_info);

        $io->section('connection the fastest one server');

        $io->block('connection ' . $fastest_vpn_connection_name . '...');

        $this->system->connection($fastest_vpn_connection_name);

        $connection_status = $this->system->checkConnectionStatus($fastest_vpn_connection_name);

        if ($connection_status) {
            $io->success('connection success.');
        } else {
            $io->error('connection error.');
        }
    }

    public function getServers(SymfonyStyle $io)
    {
        $io->section('read VPN server list');

        $servers_command = $this->getApplication()->get('servers');

        $servers = $servers_command->execute(new ArgvInput(), new NullOutput());

        if (empty($servers)) {
            throw new \ErrorException('read VPN server list failed!');
        } else {
            $io->block(sprintf('get %d servers from system configuration file', count($servers)));
        }

        return $servers;
    }
}