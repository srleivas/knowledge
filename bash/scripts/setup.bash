while getopts d:p: flag
    do
        case $flag in
            d) dev=$OPTARG;;
            p) personal=$OPTARG;;
        esac
    done

# Todo - opt out of dev or personal
apt update;

BASE_PATH=$(pwd);
UBUNTU_FOLDER="${BASE_PATH}/packages/ubuntu";
SNAP_FOLDER="${BASE_PATH}/packages/snap"

# Personal
apt install -y $(cat ${UBUNTU_FOLDER}/personal.txt);
snap install $(cat ${SNAP_FOLDER}/personal.txt);

# Development
apt install -y $(cat ${UBUNTU_FOLDER}/dev.txt);
snap install $(cat ${SNAP_FOLDER}/dev.txt);