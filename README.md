# PHP array vs object time and memory benchmark
Timing and memory measurement originally created when my PHPUnit tests started taking up over an hour of time and consuming over 9GB of memory.
Then I decided to push it on repository for others to use, after I searched for some comparitions on internet and found very basic ones.
I then expanded testing to the earlier version of PHP when I realized that many people are still using it.

## My results

*Command:*
```
docker exec prinstpl_php_array_vs_object_benchmark-php_74-1 php -f /opt/project/test.php ; sleep 5 ; docker exec prinstpl_php_array_vs_object_benchmark-php_80-1 php -f /opt/project/test.php ; sleep 5 ; docker exec prinstpl_php_array_vs_object_benchmark-php_81-1 php -f /opt/project/test.php ; sleep 5 ; docker exec prinstpl_php_array_vs_object_benchmark-php_82-1 php -f /opt/project/test.php ; sleep 5 ; docker exec prinstpl_php_array_vs_object_benchmark-php_83-1 php -f /opt/project/test.php
```

The screenshots was taken from the test results on my local machines from Docker containers. PDF file is in the "assets" folder.

### Windows 11 Pro 23H2, Core i7-12700K
![image](https://github.com/PrInStPL/PhpArrayVsObjectBenchmark/assets/123449491/5c3d9d2b-3774-48b7-9f31-4c2fb345ee77)

### Ubuntu 22.04.4 LTS, Core i7-4700HQ
![image](https://github.com/PrInStPL/PhpArrayVsObjectBenchmark/assets/123449491/2c9be86e-a6da-4237-85ef-b1a036290d39)
