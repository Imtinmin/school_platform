# school_platform
用laravel编写的学校练习平台 



## 使用

```
cp .env.example .env
```

修改里面的信息



nginx 配置 配合`dist`文件夹里的前端文件

```conf
server {
    listen 80;

    root /var/www/html/dist;
    index index.html;
    location / {
        try_files $uri $uri/ =404;
    }

    location /API/ {
        proxy_pass http://127.0.0.1:8080;
    }
}

server {
    listen 8000;
    index index.php;
    root /var/www/html/public;
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    
    }
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php7.2-fpm.sock;
    }
}

```



改好后

```
php artisan migrate  #建表
php artisan serve	#启动
```



## 功能

- ctf 答题

- 课程学习

-  测验

- 公告

  ***

  后台

- 添加课程
- 添加ctf题目

- 添加课程的测验，章节的测验 
- 查看测验记录，修改添加信息……