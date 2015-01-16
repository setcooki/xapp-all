### Overview

This repo is playground for adjusting xapp modules to composer installs and other variants. 

Currently all modules are add via git submodule in xapp/...

### Adding git submodules 

Examples:
 
 1. git submodule add git@github.com:setcooki/xapp-orm.git xapp/Orm
 2. git submodule add git@github.com:setcooki/xapp-rpc.git xapp/Rpc
 
### Working with sub modules 

In general its a pain compared to SVN. To bypass this:
 
 1. Create bash-script in /usr/bin/gitc with that content:
  
  ``` bash 
      #!/bin/sh
      what=.
      message = "auto-commit"
      if [[ -n $1 ]];
          then what=$1;
      fi
      
      
      if [[ -n $2 ]];
          then message=$2;
      fi
      echo "commit with messge " "$message"
      
      git commit -m="$message" "$what"
      
      git push
  ```
  
  2. Create bash-script in /usr/bin/gitu with that content:
  
  ``` bash 
       git submodule foreach git pull origin master
  ```
  
  3. Example scenario: commit changes in a sub-module:
  
  ``` bash
        # cd xapp/Rpc
        # gitc
  ```
  
  4. Example scenario: get changes for all sub-modules:
  
  ``` bash
          # cd folder outside of sub module 
          # gitu
    ```