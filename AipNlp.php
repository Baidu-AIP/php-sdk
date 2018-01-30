<?php
/*
* Copyright (c) 2017 Baidu.com, Inc. All Rights Reserved
*
* Licensed under the Apache License, Version 2.0 (the "License"); you may not
* use this file except in compliance with the License. You may obtain a copy of
* the License at
*
* Http://www.apache.org/licenses/LICENSE-2.0
*
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
* WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
* License for the specific language governing permissions and limitations under
* the License.
*/

require_once 'lib/AipBase.php';
class AipNlp extends AipBase {

    /**
     * 词法分析 lexer api url
     * @var string
     */
    private $lexerUrl = 'https://aip.baidubce.com/rpc/2.0/nlp/v1/lexer';

    /**
     * 词法分析（定制版） lexer_custom api url
     * @var string
     */
    private $lexerCustomUrl = 'https://aip.baidubce.com/rpc/2.0/nlp/v1/lexer_custom';

    /**
     * 依存句法分析 dep_parser api url
     * @var string
     */
    private $depParserUrl = 'https://aip.baidubce.com/rpc/2.0/nlp/v1/depparser';

    /**
     * 词向量表示 word_embedding api url
     * @var string
     */
    private $wordEmbeddingUrl = 'https://aip.baidubce.com/rpc/2.0/nlp/v2/word_emb_vec';

    /**
     * DNN语言模型 dnnlm_cn api url
     * @var string
     */
    private $dnnlmCnUrl = 'https://aip.baidubce.com/rpc/2.0/nlp/v2/dnnlm_cn';

    /**
     * 词义相似度 word_sim_embedding api url
     * @var string
     */
    private $wordSimEmbeddingUrl = 'https://aip.baidubce.com/rpc/2.0/nlp/v2/word_emb_sim';

    /**
     * 短文本相似度 simnet api url
     * @var string
     */
    private $simnetUrl = 'https://aip.baidubce.com/rpc/2.0/nlp/v2/simnet';

    /**
     * 评论观点抽取 comment_tag api url
     * @var string
     */
    private $commentTagUrl = 'https://aip.baidubce.com/rpc/2.0/nlp/v2/comment_tag';

    /**
     * 情感倾向分析 sentiment_classify api url
     * @var string
     */
    private $sentimentClassifyUrl = 'https://aip.baidubce.com/rpc/2.0/nlp/v1/sentiment_classify';

    /**
     * 文章标签 keyword api url
     * @var string
     */
    private $keywordUrl = 'https://aip.baidubce.com/rpc/2.0/nlp/v1/keyword';

    /**
     * 文章分类 topic api url
     * @var string
     */
    private $topicUrl = 'https://aip.baidubce.com/rpc/2.0/nlp/v1/topic';

    /**
     * 格式化结果
     * @param $content string
     * @return mixed
     */
    protected function proccessResult($content){
        return json_decode(mb_convert_encoding($content, 'UTF8', 'GBK'), true, 512, JSON_BIGINT_AS_STRING);
    }

    /**
     * 词法分析接口
     *
     * @param string $text - 待分析文本（目前仅支持GBK编码），长度不超过65536字节
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     */
    public function lexer($text, $options=array()){

        $data = array();
        
        $data['text'] = $text;

        $data = array_merge($data, $options);
        $data = mb_convert_encoding(json_encode($data), 'GBK', 'UTF8');

        return $this->request($this->lexerUrl, $data);
    }

    /**
     * 词法分析（定制版）接口
     *
     * @param string $text - 待分析文本（目前仅支持GBK编码），长度不超过65536字节
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     */
    public function lexerCustom($text, $options=array()){

        $data = array();
        
        $data['text'] = $text;

        $data = array_merge($data, $options);
        $data = mb_convert_encoding(json_encode($data), 'GBK', 'UTF8');

        return $this->request($this->lexerCustomUrl, $data);
    }

    /**
     * 依存句法分析接口
     *
     * @param string $text - 待分析文本（目前仅支持GBK编码），长度不超过256字节
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   mode 模型选择。默认值为0，可选值mode=0（对应web模型）；mode=1（对应query模型）
     * @return array
     */
    public function depParser($text, $options=array()){

        $data = array();
        
        $data['text'] = $text;

        $data = array_merge($data, $options);
        $data = mb_convert_encoding(json_encode($data), 'GBK', 'UTF8');

        return $this->request($this->depParserUrl, $data);
    }

    /**
     * 词向量表示接口
     *
     * @param string $word - 文本内容（GBK编码），最大64字节
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     */
    public function wordEmbedding($word, $options=array()){

        $data = array();
        
        $data['word'] = $word;

        $data = array_merge($data, $options);
        $data = mb_convert_encoding(json_encode($data), 'GBK', 'UTF8');

        return $this->request($this->wordEmbeddingUrl, $data);
    }

    /**
     * DNN语言模型接口
     *
     * @param string $text - 文本内容（GBK编码），最大512字节，不需要切词
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     */
    public function dnnlm($text, $options=array()){

        $data = array();
        
        $data['text'] = $text;

        $data = array_merge($data, $options);
        $data = mb_convert_encoding(json_encode($data), 'GBK', 'UTF8');

        return $this->request($this->dnnlmCnUrl, $data);
    }

    /**
     * 词义相似度接口
     *
     * @param string $word1 - 词1（GBK编码），最大64字节
     * @param string $word2 - 词1（GBK编码），最大64字节
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   mode 预留字段，可选择不同的词义相似度模型。默认值为0，目前仅支持mode=0
     * @return array
     */
    public function wordSimEmbedding($word1, $word2, $options=array()){

        $data = array();
        
        $data['word_1'] = $word1;
        $data['word_2'] = $word2;

        $data = array_merge($data, $options);
        $data = mb_convert_encoding(json_encode($data), 'GBK', 'UTF8');

        return $this->request($this->wordSimEmbeddingUrl, $data);
    }

    /**
     * 短文本相似度接口
     *
     * @param string $text1 - 待比较文本1（GBK编码），最大512字节
     * @param string $text2 - 待比较文本2（GBK编码），最大512字节
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   model 默认为"BOW"，可选"BOW"、"CNN"与"GRNN"
     * @return array
     */
    public function simnet($text1, $text2, $options=array()){

        $data = array();
        
        $data['text_1'] = $text1;
        $data['text_2'] = $text2;

        $data = array_merge($data, $options);
        $data = mb_convert_encoding(json_encode($data), 'GBK', 'UTF8');

        return $this->request($this->simnetUrl, $data);
    }

    /**
     * 评论观点抽取接口
     *
     * @param string $text - 评论内容（GBK编码），最大10240字节
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   type 评论行业类型，默认为4（餐饮美食）
     * @return array
     */
    public function commentTag($text, $options=array()){

        $data = array();
        
        $data['text'] = $text;

        $data = array_merge($data, $options);
        $data = mb_convert_encoding(json_encode($data), 'GBK', 'UTF8');

        return $this->request($this->commentTagUrl, $data);
    }

    /**
     * 情感倾向分析接口
     *
     * @param string $text - 文本内容（GBK编码），最大102400字节
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     */
    public function sentimentClassify($text, $options=array()){

        $data = array();
        
        $data['text'] = $text;

        $data = array_merge($data, $options);
        $data = mb_convert_encoding(json_encode($data), 'GBK', 'UTF8');

        return $this->request($this->sentimentClassifyUrl, $data);
    }

    /**
     * 文章标签接口
     *
     * @param string $title - 篇章的标题，最大80字节
     * @param string $content - 篇章的正文，最大65535字节
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     */
    public function keyword($title, $content, $options=array()){

        $data = array();
        
        $data['title'] = $title;
        $data['content'] = $content;

        $data = array_merge($data, $options);
        $data = mb_convert_encoding(json_encode($data), 'GBK', 'UTF8');

        return $this->request($this->keywordUrl, $data);
    }

    /**
     * 文章分类接口
     *
     * @param string $title - 篇章的标题，最大80字节
     * @param string $content - 篇章的正文，最大65535字节
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     */
    public function topic($title, $content, $options=array()){

        $data = array();
        
        $data['title'] = $title;
        $data['content'] = $content;

        $data = array_merge($data, $options);
        $data = mb_convert_encoding(json_encode($data), 'GBK', 'UTF8');

        return $this->request($this->topicUrl, $data);
    }
}