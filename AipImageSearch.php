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
class AipImageSearch extends AipBase {

    /**
     * 相同图检索—入库 same_hq_add api url
     * @var string
     */
    private $sameHqAddUrl = 'https://aip.baidubce.com/rest/2.0/realtime_search/same_hq/add';

    /**
     * 相同图检索—检索 same_hq_search api url
     * @var string
     */
    private $sameHqSearchUrl = 'https://aip.baidubce.com/rest/2.0/realtime_search/same_hq/search';

    /**
     * 相同图检索—删除 same_hq_delete api url
     * @var string
     */
    private $sameHqDeleteUrl = 'https://aip.baidubce.com/rest/2.0/realtime_search/same_hq/delete';

    /**
     * 相似图检索—入库 similar_add api url
     * @var string
     */
    private $similarAddUrl = 'https://aip.baidubce.com/rest/2.0/image-classify/v1/realtime_search/similar/add';

    /**
     * 相似图检索—检索 similar_search api url
     * @var string
     */
    private $similarSearchUrl = 'https://aip.baidubce.com/rest/2.0/image-classify/v1/realtime_search/similar/search';

    /**
     * 相似图检索—删除 similar_delete api url
     * @var string
     */
    private $similarDeleteUrl = 'https://aip.baidubce.com/rest/2.0/image-classify/v1/realtime_search/similar/delete';

    /**
     * 商品检索—入库 product_add api url
     * @var string
     */
    private $productAddUrl = 'https://aip.baidubce.com/rest/2.0/image-classify/v1/realtime_search/product/add';

    /**
     * 商品检索—检索 product_search api url
     * @var string
     */
    private $productSearchUrl = 'https://aip.baidubce.com/rest/2.0/image-classify/v1/realtime_search/product/search';

    /**
     * 商品检索—删除 product_delete api url
     * @var string
     */
    private $productDeleteUrl = 'https://aip.baidubce.com/rest/2.0/image-classify/v1/realtime_search/product/delete';

    

    /**
     * 相同图检索—入库接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   brief 检索时原样带回,最长256B。
     * @return array
     */
    public function sameHqAdd($image, $options=array()){

        $data = array();
        
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request($this->sameHqAddUrl, $data);
    }

    /**
     * 相同图检索—检索接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     */
    public function sameHqSearch($image, $options=array()){

        $data = array();
        
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request($this->sameHqSearchUrl, $data);
    }

    /**
     * 相同图检索—删除接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     */
    public function sameHqDeleteByImage($image, $options=array()){

        $data = array();
        
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request($this->sameHqDeleteUrl, $data);
    }

    /**
     * 相同图检索—删除接口
     *
     * @param string $contSign - 图片签名（和image二选一，image优先级更高）
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     */
    public function sameHqDeleteBySign($contSign, $options=array()){

        $data = array();
        
        $data['cont_sign'] = $contSign;

        $data = array_merge($data, $options);

        return $this->request($this->sameHqDeleteUrl, $data);
    }

    /**
     * 相似图检索—入库接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   brief 检索时原样带回,最长256B。
     * @return array
     */
    public function similarAdd($image, $options=array()){

        $data = array();
        
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request($this->similarAddUrl, $data);
    }

    /**
     * 相似图检索—检索接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     */
    public function similarSearch($image, $options=array()){

        $data = array();
        
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request($this->similarSearchUrl, $data);
    }

    /**
     * 相似图检索—删除接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     */
    public function similarDeleteByImage($image, $options=array()){

        $data = array();
        
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request($this->similarDeleteUrl, $data);
    }

    /**
     * 相似图检索—删除接口
     *
     * @param string $contSign - 图片签名（和image二选一，image优先级更高）
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     */
    public function similarDeleteBySign($contSign, $options=array()){

        $data = array();
        
        $data['cont_sign'] = $contSign;

        $data = array_merge($data, $options);

        return $this->request($this->similarDeleteUrl, $data);
    }

    /**
     * 商品检索—入库接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   brief 检索时原样带回,最长256B。**请注意，检索接口不返回原图，仅反馈当前填写的brief信息，所以调用该入库接口时，brief信息请尽量填写可关联至本地图库的图片id或者图片url、图片名称等信息**
     *   class_id1 商品分类维度1，支持1-60范围内的整数。检索时可圈定该分类维度进行检索
     *   class_id2 商品分类维度1，支持1-60范围内的整数。检索时可圈定该分类维度进行检索
     * @return array
     */
    public function productAdd($image, $options=array()){

        $data = array();
        
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request($this->productAddUrl, $data);
    }

    /**
     * 商品检索—检索接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   class_id1 商品分类维度1，支持1-60范围内的整数。检索时可圈定该分类维度进行检索
     *   class_id2 商品分类维度1，支持1-60范围内的整数。检索时可圈定该分类维度进行检索
     * @return array
     */
    public function productSearch($image, $options=array()){

        $data = array();
        
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request($this->productSearchUrl, $data);
    }

    /**
     * 商品检索—删除接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     */
    public function productDeleteByImage($image, $options=array()){

        $data = array();
        
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request($this->productDeleteUrl, $data);
    }

    /**
     * 商品检索—删除接口
     *
     * @param string $contSign - 图片签名（和image二选一，image优先级更高）
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     */
    public function productDeleteBySign($contSign, $options=array()){

        $data = array();
        
        $data['cont_sign'] = $contSign;

        $data = array_merge($data, $options);

        return $this->request($this->productDeleteUrl, $data);
    }
}

