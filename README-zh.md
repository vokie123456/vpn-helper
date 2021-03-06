# VPN Helper

![](http://oac57xnsh.bkt.clouddn.com/vpn-helper.png)

## 文档

 [中文](https://github.com/springjk/vpn-helper/blob/master/README-zh.md) | [English](https://github.com/springjk/vpn-helper/blob/master/README.md)

## 背景

很多 VPN 服务商提供了多个服务器供我们使用，但是他们大多数都没有提供测试最佳线路工具。我们可以使用 `ping`进行测速得到延迟最低的一个服务器，但遗憾的是很多情况下复杂的网络环境使服务器线路的延迟经常变化，这时使用 `VPN Helper` 可以快速的连接延迟最低的一个。

## 依赖

* PHP >= 5.6

## 安装

``` bash
$ curl -sS https://raw.githubusercontent.com/springjk/vpn-helper/master/installer | php
```

## 使用

**测速并连接**

``` shell
$ vpn run
```

**查看 VPN 列表**

``` shell
$ vpn servers
```

**功能菜单**

``` shell
$ vpn

Vpn helper version v1.2.0 build b5b6469

Usage:
  command [options] [arguments]

Options:
  -h, --help            Display this help message
  -q, --quiet           Do not output any message
  -V, --version         Display this application version
      --ansi            Force ANSI output
      --no-ansi         Disable ANSI output
  -n, --no-interaction  Do not ask any interactive question
  -v|vv|vvv, --verbose  Increase the verbosity of messages

Available commands:
  connection  Connection a vpn server by connection name
  help        Displays help for a command
  list        Lists commands
  ping        Ping test all vpn servers and display result
  run         Ping test all vpn servers and connection the fastest one
  servers     Displays all vpn servers
```

## 协议

MIT