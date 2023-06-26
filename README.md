# Project nosql

# Installation 
To run the project locally, you'll need :

- wsl 2 installed 
- docker installed on wsl 2 
- git installed on wsl 2

## Wsl 2 installation steps

Run powershell as administrator and run the following commands : 

```bash
dism.exe /online /enable-feature /featurename:Microsoft-Windows-Subsystem-Linux /all /norestart
dism.exe /online /enable-feature /featurename:VirtualMachinePlatform /all /norestart
 ```

Download the wsl2 installer and execute it : 
https://wslstorestorage.blob.core.windows.net/wslblob/wsl_update_x64.msi

In powershell, run `wsl --set-default-version 2`

Install ubuntu in the microsoft store 

Restart Windows

Run the ubuntu app and create a user

## Docker installation steps

First of all, you need to activate the virtualisation in your bios

Then, restart your pc 

Download docker desktop installer using this link : https://www.docker.com/products/docker-desktop/ and execute it

Open the docker desktop app, it will start the docker daemon

Open the ubuntu shell and run the following commands :

```bash
    sudo groupadd docker
    sudo usermod -aG docker $USER
    newgrp docker
```

## Install git 

Open the ubuntu shell and run the following command :

```bash
    sudo apt-get install git 
```

## Clone the project

You need an SSH key to clone the project from github

If your key isn't set, open the ubuntu shell and run the following commands :

```bash
    cd 
    ssh-keygen 
    cat .ssh/id-rsa.pub
```

Add the output of the last command as a ssh key here : https://github.com/settings/keys

Clone the project using `git clone git@github.com:romainsilvy/project-nosql.git`

Go in the project folder : `cd project-nosql`

## Setup the project to run locally 

Install the composer dependencies using 

```bash
    docker run --rm --interactive --tty \
    --volume $PWD:/app \
    composer install --ignore-platform-reqs
```

Then,

* `cp .env.example .env`
* `./vendor/bin/sail up`

## Usage

In order to import the given data, run the following command : 

```bash
    ./vendor/bin/sail artisan command:import-csv 
```
