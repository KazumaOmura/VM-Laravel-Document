### VagrantでUbuntuをインストール
```
$ vagrant init ubuntu/trusty64
```

### Vagrantfileを修正
```
Vagrant.configure("2") do |config|
  config.vm.box = "ubuntu/trusty64"
  config.vm.network "private_network", ip: "192.168.56.11"
end
```

※ここまでは設定済み

### Ubuntuを起動
```
$ vagrant up
```

### Vagrant Configを確認
```
$ vagrant ssh-config

IdentityFileのパスをメモする
```

### Shellにログイン
```
$ ssh -l vagrant -i [IdentityFileのパス] 192.168.56.11
ssh -l vagrant -i /Users/omurakazuma/Development/YouTube_AB_VM/.vagrant/machines/default/virtualbox/private_key 192.168.56.11
```

### sshの認証を変更
```
$ sudo vim /etc/ssh/sshd_config

PasswordAuthentication no
↓
PasswordAuthentication yes

```

### 変更を適用
```
$ sudo systemctl restart sshd
```

### Shellを抜ける
```
$ exit
```

### SSH鍵をコピー
```
$ ssh-copy-id -i ~/.ssh/id_rsa vagrant@192.168.56.11
password:vagrant
```

### ssh接続
```
$ ssh vagrant@192.168.56.11
```

### Ansibleディレクトリに移動
```
cd vagrant
```

### Ansible hosts修正
```
[web]
192.168.56.11
```

### Ansible実行
```
$ ansible-playbook -i hosts main.yml -u vagrant
```

### Laravelインストール
```
$ sudo composer create-project laravel/laravel YouTube_AB --ignore-platform-req=ext-dom --ignore-platform-req=ext-xml --ignore-platform-req=ext-xmlwriter
```
rootディレクトリ(/var/www/html)内で実行する．

### 権限変更
```
$ sudo chmod 777 /var/www/html/YouTube_AB/storage/framework/sessions/
$ sudo chmod 777 /var/www/html/YouTube_AB/storage/framework/views/
$ sudo chmod 777 /var/www/html/YouTube_AB/storage/framework/logs/
```