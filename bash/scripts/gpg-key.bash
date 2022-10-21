email=xdev.noc@gmail.com;
name=vinicius;
expire=1m

while getopts m:n:e: flag
    do 
        case "${flag}" in
            m) email=${OPTARG};;
            n) name=${OPTARG};;
            e) expire=${OPTARG};;
            *) ;;
        esac
    done
  exit;


gpg --batch --gen-key <<EOF
    Key-Type: 1
    Key-Length: 4096
    Subkey-Type: 1
    Subkey-Length: 4096
    Name-Real: ${name}
    Name-Email: ${email}
    Expire-Date: ${expire}
EOF

clear && gpg --list-secret-keys --keyid-format=long;
read -r -i '' -p "Select ONLY your private key id (rsaXXXX/keyID): " privatekeyid

git config --global user.signingkey "$privatekeyid"
[ -f ~/.bashrc ] && echo "export GPG_TTY=$(tty)" >> ~/.bashrc

clear && gpg --list-keys --keyid-format=long;
read -r -i '' -p "Select ONLY your public key id (rsaXXXX/keyID): " publickeyid

clear && gpg --armor --export "$publickeyid";

read -r -i '' -p 'Habilitar assinatura globalmente? (Default=local) (y/n): ' globalsign
clear 

if [ "$globalsign" == "y" ] || [ "$globalsign" == 'yes' ]; then
    git config --global --unset gpg.format
    git config --global commit.gpgsign true
else 
    git config --unset gpg.format
    git config commit.gpgsign true
fi
