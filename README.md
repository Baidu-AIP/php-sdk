# 安装PHP SDK

## 目录结构
```
  ├── AipOcr.php                // OCR
  ├── AipFace.php               // 人脸
  ├── AipImageCensor.php        // 图像审核
  ├── AipImageClassify.php      // 图像识别
  ├── AipKg.php                 // 知识图谱
  ├── AipSpeech.php             // 语音
  └── lib
      ├── AipHttpClient.php        //内部http请求类
      ├── AipBCEUtil.php           //内部工具类
      └── AipBase                  //Aip基类
```

** 支持 PHP版本：5.3+ **

** 直接使用php开发包步骤如下：**

1. 下载PHP SDK。

2. 复制Aip*.php以及lib/*到工程。

3. require_once '对应服务';


# 使用文档

参考[官方网站](http://ai.baidu.com/docs#/Begin/top)
