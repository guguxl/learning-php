**本文档记录了安装带apache支持（生成libphp7.so文件）的php7版本的步骤。**

### 1、如果没有安装homebrew，则安装homebrew

> $ /usr/bin/ruby -e "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install)"

具体见网址：http://brew.sh/index_zh-cn.html

常用命令：brew update,    brew doctor,     brew prune,    brew install xxxx

如果之前有使用过brew安装过较低版本的PHP，则先使用 brew uninstall phpxx

具体用法，可以用 brew help查看。

### 2、安装xcode-select

安装php7.1需要用到该软件，否则会报“configure: error: Cannot find libz”错误，导致安装失败。

> $ xcode-select --install

命令会弹出提示安装的框，点击“install”按钮即可。

### 3、安装php7.1

> $ brew install php71 --with-httpd24 --with-debug --with-gmp --with-imap

注意，上面的命令中 --with-httpd24 选项，表示安装带apache支持的php。安装后将会有一大段文字，如下：

Updating Homebrew...
==> Installing php71 from homebrew/php
==> Downloading https://php.net/get/php-7.1.0.tar.bz2/from/this/mirror
Already downloaded: /Users/guxl/Library/Caches/Homebrew/php71-7.1.0
==> ./configure --prefix=/usr/local/Cellar/php71/7.1.0_11 --localstatedir=/usr/local/var --sysconfdir=/usr/local/etc/php/7.1 --with-config-file-path=/usr/loca
==> make
==> make install
==> Caveats
**<u>To enable PHP in Apache add the following to httpd.conf and restart Apache:</u>**

    LoadModule php7_module    /usr/local/opt/php71/libexec/apache2/libphp7.so

    <FilesMatch .php$>
        SetHandler application/x-httpd-php
    </FilesMatch>

Finally, <u>**check DirectoryIndex includes index.php**</u>
    DirectoryIndex index.php index.html

**<u>The php.ini file can be found in:</u>**
    /usr/local/etc/php/7.1/php.ini
#### **<u>✩✩✩✩ Extensions ✩✩✩✩</u>**

If you are having issues with custom extension compiling, ensure that
you are using the brew version, <u>**by placing /usr/local/bin before /usr/sbin in your PATH:**</u>

      PATH="/usr/local/bin:$PATH"

PHP71 Extensions will always be compiled against this PHP. Please install them
using --without-homebrew-php to enable compiling against system PHP.

#### **<u>✩✩✩✩ PHP CLI ✩✩✩✩</u>**

If you wish to swap the PHP you use on the command line, you should add the following to ~/.bashrc,
~/.zshrc, ~/.profile or your shell's equivalent configuration file:

      export PATH="$(brew --prefix homebrew/php/php71)/bin:$PATH"

**GMP has moved to its own formula, please install it by running: brew install php71-gmp**

#### **<u>✩✩✩✩ FPM ✩✩✩✩</u>**

**To launch php-fpm on startup:**
    mkdir -p ~/Library/LaunchAgents
    cp /usr/local/opt/php71/homebrew.mxcl.php71.plist ~/Library/LaunchAgents/
    launchctl load -w ~/Library/LaunchAgents/homebrew.mxcl.php71.plist

The control script is located at **/usr/local/opt/php71/sbin/php71-fpm**

OS X 10.8 and newer come with php-fpm pre-installed, **to ensure you are using the brew version you need to make sure /usr/local/sbin is before /usr/sbin in your PATH:**

  PATH="/usr/local/sbin:$PATH"

You may also need to edit the plist to use the correct "UserName".

Please note that the plist was called 'homebrew-php.josegonzalez.php71.plist' in old versions
of this formula.

With the release of macOS Sierra the Apache module is now not built by default. If you want to build it on your system,  you have to install php with the **--with-httpd24** option. See  brew options php71  for more details.

To have launchd start homebrew/php/php71 now and restart at login:
  **<u>brew services start homebrew/php/php71</u>**
==> Summary
🍺  /usr/local/Cellar/php71/7.1.0_11: 343 files, 57.6M, built in 4 minutes 9 seconds



### 4、配置php和apache组合使用

最新版本的PHP已经内置了webserver，在开发模式时，我们可以使用如下命令启动内置web服务器。

可根据具体情况指定服务器的端口，-t选项用来指定web服务器的文档根目录。

> $ php -S localhost:9000 -t /DocumentRoot

但在实际发布代码时，仍然需要配置apache来和PHP组合使用。详细配置步骤见文档。

https://zhuanlan.zhihu.com/p/24614926

