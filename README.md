### Overview

This repo is playground for adjusting xapp modules to composer installs and other variants. 

Currently all modules are added via git submodule in xapp/...


### Working with this repo

checkout:
    
    $ git clone --recursive https://github.com/setcooki/xapp-all
    $ cd xapp-all
    $ git submodule foreach "git checkout master"
    
### Initial submodule init

Also necessary for new modules after cloning:

    $ cd xapp-all
    $ git pull
    $ git submodule init
    $ git submodule update
    $ git submodule foreach 'git checkout master'

### Adding git submodules 

Examples:
 
    $ git submodule add https://github.com/setcooki/xapp-core.git xapp/core
    $ git submodule add https://github.com/setcooki/xapp-rpc.git xapp/rpc
 
### Working with sub modules 

In general its a pain compared to SVN. To bypass this:
 
1. Create bash-script in /usr/bin/gitc with that content:
  
    ``` bash 
        
       #!/bin/sh
       what=.
       message="auto-commit"
       
       if [ "$2" ]
           then what=$2;
       fi
       
       
       if [ "$1" ]
           then message=$1;
       fi
       
       echo "commit with messge " $message " on directory:"  $what
       
       git commit -m=$message $what
       
       git push
       
    ```
    
    This allows you to commit more easy: 
        
    Commit current directory with default message auto-commit :
                
        $ gitc
        
    Commit specific directory with default message auto-commit :
                    
        $ gitc "fixes included" ./test
        
        
    
    
    
  
  
2. Create bash-script in /usr/bin/gitu with that content:
  
    
        $ git submodule foreach git pull origin master
    
  
3. Example scenario: commit changes in a sub-module:
  
        $ cd xapp/Rpc
        $ gitc
    
  
4. Example scenario: get changes for all sub-modules:
  
        $ cd folder outside of sub module 
        $ gitu

    
5. Example scenario: commit all changes in all sub-modules in one row:
  
        $ cd xapp-all (parent repo) 
        $ git submodule foreach 'gitc || :'

  
6. Example scenario: pull all changes in all sub-modules in one row:
    
    ``` bash
        # cd xapp-all (parent repo) 
        # git submodule foreach 'git pull || :'
    ```
  
7. put this here in your ~/.gitconfig :
  
    ``` bash
    
        [alias]
        rms = "!f(){ git rm --cached \"$1\";rm -r \"$1\";git config -f .gitmodules --remove-section \"submodule.$1\";git config -f .git/config --remove-section \"submodule.$1\";git add .gitmodules; }; f"  
  ```
   
8. then you can remove git submodules by:
 
    ``` bash
    
        cd xapp-all
    
        git rms xapp/Core
    
        # and to re-add it 
    
        git submodule add https://github.com/setcooki/xapp-core.git xapp/core
            
    ```
    
9. Example scenario: push all changes in all sub-modules in one row:
    
    Create an bash script /usr/bin/gitcs with that content:
    
    git submodule foreach 'gitc || :'
    
    then 
    
    ``` bash
        # cd xapp-all  
        # gitcs
    ```

       
       
        
  

