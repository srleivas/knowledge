apt update;
BASE_PATH=$(pwd);
UBUNTU_FOLDER="$BASE_PATH/packages/ubuntu";
SNAP_FOLDER="$BASE_PATH/packages/snap"

# Personal
 apt install "$(cat "$UBUNTU_FOLDER"/personal.txt)";
 snap install "$(cat "$SNAP_FOLDER"/personal.txt)";

# Development
 apt install "$(cat "$UBUNTU_FOLDER"/dev.txt)";
 snap install "$(cat "$SNAP_FOLDER"/dev.txt)";