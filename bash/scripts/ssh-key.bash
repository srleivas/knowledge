ssh-keygen -t ed25519
ssh-agent -s
ssh-add ~/.ssh/id_ed25519

clear

echo "============= Public Key ==============="
cat ~/.ssh/id_ed25519.pub
echo "========================================"