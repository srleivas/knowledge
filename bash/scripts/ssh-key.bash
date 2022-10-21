date=$(date "+%Y.%m.%d-%H.%M.%S")

ssh-keygen -t ed25519 -f ~/.ssh/key_"${date}"
ssh-agent -s && clear
ssh-add ~/.ssh/key_"${date}"

echo "============= Public Key ==============="
clear && cat ~/.ssh/id_ed25519.pub
echo "========================================"