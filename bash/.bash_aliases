# Uso geral
apache-folder() {
    path="/var/www/html"

    if [ $1 ]; then
        path="${path}/${1}";
    fi;

    cd $path;
}

documents-folder(){
    path="/home/$(whoami)/Doc*";

    if [ $1 ]; then
        path="$path/$1";
    fi

    cd $path;
};

# Para projetos com code sniffer
psr-fix() {
    psr_check_command="./vendor/bin/phpcbf --standard=PSR12 ${1}";

    if [ $2 ]; then
        psr_check_command="./vendor/bin/phpcbf --standard=${2} ${1}";
    fi

    eval $psr_check_command;
}

psr-check() {
    psr_check_command="./vendor/bin/phpcs --standard=PSR12 ${1}";

    if [ $2 ]; then
        psr_check_command="./vendor/bin/phpcs --standard=${2} ${1}";
    fi

    eval $psr_check_command;
}

# e-cidade related
alias e-cidade="cd /var/www/html/e-cidade";
alias git-fetch="git fetch --all -p -P -q";

alias git-cleanup="git branch --merged master | egrep -v '(^\*|master)' | xargs git branch -D";