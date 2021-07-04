node = {
    :name => "gbhl",
    :host => "gbhl.local",
    :box => "centos/7",
    :ip => "192.168.111.111",
    :mem => "1024",
    :cpu => "2",
}

Vagrant.configure("2") do |config|
    config.vm.define node[:name] do |cfg|
        cfg.vm.box = node[:box]
        cfg.vm.hostname = node[:host]
        cfg.vm.network :private_network, ip: node[:ip]
        cfg.vm.provider "virtualbox" do |vb|
            vb.name = node[:name]
            vb.memory = node[:mem]
            vb.cpus = node[:cpu]
        end
    end
end