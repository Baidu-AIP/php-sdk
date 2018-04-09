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
class AipFace extends AipBase {

    /**
     * 人脸检测 detect api url
     * @var string
     */
    private $detectUrl = 'https://aip.baidubce.com/rest/2.0/face/v2/detect';

    /**
     * 人脸比对 match api url
     * @var string
     */
    private $matchUrl = 'https://aip.baidubce.com/rest/2.0/face/v2/match';

    /**
     * 人脸识别 identify api url
     * @var string
     */
    private $identifyUrl = 'https://aip.baidubce.com/rest/2.0/face/v2/identify';

    /**
     * 人脸认证 verify api url
     * @var string
     */
    private $verifyUrl = 'https://aip.baidubce.com/rest/2.0/face/v2/verify';

    /**
     * M:N 识别 multi_identify api url
     * @var string
     */
    private $multiIdentifyUrl = 'https://aip.baidubce.com/rest/2.0/face/v2/multi-identify';

    /**
     * 人脸注册 user_add api url
     * @var string
     */
    private $userAddUrl = 'https://aip.baidubce.com/rest/2.0/face/v2/faceset/user/add';

    /**
     * 人脸更新 user_update api url
     * @var string
     */
    private $userUpdateUrl = 'https://aip.baidubce.com/rest/2.0/face/v2/faceset/user/update';

    /**
     * 人脸删除 user_delete api url
     * @var string
     */
    private $userDeleteUrl = 'https://aip.baidubce.com/rest/2.0/face/v2/faceset/user/delete';

    /**
     * 用户信息查询 user_get api url
     * @var string
     */
    private $userGetUrl = 'https://aip.baidubce.com/rest/2.0/face/v2/faceset/user/get';

    /**
     * 组列表查询 group_getlist api url
     * @var string
     */
    private $groupGetlistUrl = 'https://aip.baidubce.com/rest/2.0/face/v2/faceset/group/getlist';

    /**
     * 组内用户列表查询 group_getusers api url
     * @var string
     */
    private $groupGetusersUrl = 'https://aip.baidubce.com/rest/2.0/face/v2/faceset/group/getusers';

    /**
     * 组间复制用户 group_adduser api url
     * @var string
     */
    private $groupAdduserUrl = 'https://aip.baidubce.com/rest/2.0/face/v2/faceset/group/adduser';

    /**
     * 组内删除用户 group_deleteuser api url
     * @var string
     */
    private $groupDeleteuserUrl = 'https://aip.baidubce.com/rest/2.0/face/v2/faceset/group/deleteuser';

    /**
     * 身份验证 person_verify api url
     * @var string
     */
    private $personVerifyUrl = 'https://aip.baidubce.com/rest/2.0/face/v2/person/verify';

    /**
     * 在线活体检测 faceverify api url
     * @var string
     */
    private $faceverifyUrl = 'https://aip.baidubce.com/rest/2.0/face/v2/faceverify';

    

    /**
     * 人脸检测接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   max_face_num 最多处理人脸数目，默认值1
     *   face_fields 包括age,beauty,expression,faceshape,gender,glasses,landmark,race,qualities信息，逗号分隔，默认只返回人脸框、概率和旋转角度
     * @return array
     */
    public function detect($image, $options=array()){

        $data = array();
        
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request($this->detectUrl, $data);
    }

    /**
     * 人脸比对接口
     *
     * @param string $images - base64编码后的多张图片数据，半角逗号分隔，单次请求总共最大20M
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   ext_fields 返回质量信息，取值固定:目前支持qualities(质量检测)。(对所有图片都会做改处理)
     *   image_liveness 返回的活体信息，“faceliveness,faceliveness” 表示对比对的两张图片都做活体检测；“,faceliveness” 表示对第一张图片不做活体检测、第二张图做活体检测；“faceliveness,” 表示对第一张图片做活体检测、第二张图不做活体检测；<br>**注：需要用于判断活体的图片，图片中的人脸像素面积需要不小于100px\*100px，人脸长宽与图片长宽比例，不小于1/3**
     *   types 请求对比的两张图片的类型，示例：“7,13”<br>**12**表示带水印证件照：一般为带水印的小图，如公安网小图<br>**7**表示生活照：通常为手机、相机拍摄的人像图片、或从网络获取的人像图片等<br>**13**表示证件照片：如拍摄的身份证、工卡、护照、学生证等证件图片，**注**：需要确保人脸部分不可太小，通常为100px\*100px
     * @return array
     */
    public function match($images, $options=array()){

        $data = array();
        
        $arr = array();
        foreach($images as $image){
            $arr[] = base64_encode($image);
        }
        $data['images'] = implode(',', $arr);

        $data = array_merge($data, $options);

        return $this->request($this->matchUrl, $data);
    }

    /**
     * 人脸识别接口
     *
     * @param string $groupId - 用户组id，标识一组用户（由数字、字母、下划线组成），长度限制128B。如果需要将一个uid注册到多个group下，group\_id需要用多个逗号分隔，每个group_id长度限制为48个英文字符。**注：group无需单独创建，注册用户时则会自动创建group。**<br>**产品建议**：根据您的业务需求，可以将需要注册的用户，按照业务划分，分配到不同的group下，例如按照会员手机尾号作为groupid，用于刷脸支付、会员计费消费等，这样可以尽可能控制每个group下的用户数与人脸数，提升检索的准确率
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   ext_fields 特殊返回信息，多个用逗号分隔，取值固定: 目前支持faceliveness(活体检测)。**注：需要用于判断活体的图片，图片中的人脸像素面积需要不小于100px\*100px，人脸长宽与图片长宽比例，不小于1/3**
     *   user_top_num 返回用户top数，默认为1，最多返回5个
     * @return array
     */
    public function identifyUser($groupId, $image, $options=array()){

        $data = array();
        
        $data['group_id'] = $groupId;
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request($this->identifyUrl, $data);
    }

    /**
     * 人脸认证接口
     *
     * @param string $uid - 用户id（由数字、字母、下划线组成），长度限制128B
     * @param string $groupId - 用户组id，标识一组用户（由数字、字母、下划线组成），长度限制128B。如果需要将一个uid注册到多个group下，group\_id需要用多个逗号分隔，每个group_id长度限制为48个英文字符。**注：group无需单独创建，注册用户时则会自动创建group。**<br>**产品建议**：根据您的业务需求，可以将需要注册的用户，按照业务划分，分配到不同的group下，例如按照会员手机尾号作为groupid，用于刷脸支付、会员计费消费等，这样可以尽可能控制每个group下的用户数与人脸数，提升检索的准确率
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   top_num 返回用户top数，默认为1
     *   ext_fields 特殊返回信息，多个用逗号分隔，取值固定: 目前支持faceliveness(活体检测)。**注：需要用于判断活体的图片，图片中的人脸像素面积需要不小于100px\*100px，人脸长宽与图片长宽比例，不小于1/3**
     * @return array
     */
    public function verifyUser($uid, $groupId, $image, $options=array()){

        $data = array();
        
        $data['uid'] = $uid;
        $data['group_id'] = $groupId;
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request($this->verifyUrl, $data);
    }

    /**
     * M:N 识别接口
     *
     * @param string $groupId - 用户组id，标识一组用户（由数字、字母、下划线组成），长度限制128B。如果需要将一个uid注册到多个group下，group\_id需要用多个逗号分隔，每个group_id长度限制为48个英文字符。**注：group无需单独创建，注册用户时则会自动创建group。**<br>**产品建议**：根据您的业务需求，可以将需要注册的用户，按照业务划分，分配到不同的group下，例如按照会员手机尾号作为groupid，用于刷脸支付、会员计费消费等，这样可以尽可能控制每个group下的用户数与人脸数，提升检索的准确率
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   ext_fields 特殊返回信息，多个用逗号分隔，取值固定: 目前支持faceliveness(活体检测)。**注：需要用于判断活体的图片，图片中的人脸像素面积需要不小于100px\*100px，人脸长宽与图片长宽比例，不小于1/3**
     *   detect_top_num 检测多少个人脸进行比对，默认值1（最对返回10个）
     *   user_top_num 返回识别结果top人数”，当同一个人有多张图片时，只返回比对最高的1个分数（即，scores参数只有一个值），默认为1（最多返回20个）
     * @return array
     */
    public function multiIdentify($groupId, $image, $options=array()){

        $data = array();
        
        $data['group_id'] = $groupId;
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request($this->multiIdentifyUrl, $data);
    }

    /**
     * 人脸注册接口
     *
     * @param string $uid - 用户id（由数字、字母、下划线组成），长度限制128B
     * @param string $userInfo - 用户资料，长度限制256B
     * @param string $groupId - 用户组id，标识一组用户（由数字、字母、下划线组成），长度限制128B。如果需要将一个uid注册到多个group下，group\_id需要用多个逗号分隔，每个group_id长度限制为48个英文字符。**注：group无需单独创建，注册用户时则会自动创建group。**<br>**产品建议**：根据您的业务需求，可以将需要注册的用户，按照业务划分，分配到不同的group下，例如按照会员手机尾号作为groupid，用于刷脸支付、会员计费消费等，这样可以尽可能控制每个group下的用户数与人脸数，提升检索的准确率
     * @param string $image - 图像base64编码，**每次仅支持单张图片，图片编码后大小不超过10M**。为保证后续识别的效果较佳，建议注册的人脸，为用户正面人脸。
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   action_type 参数包含append、replace。**如果为“replace”，则每次注册时进行替换replace（新增或更新）操作，默认为append操作**。例如：uid在库中已经存在时，对此uid重复注册时，新注册的图片默认会**追加**到该uid下，如果手动选择`action_type:replace`，则会用新图替换库中该uid下所有图片。
     * @return array
     */
    public function addUser($uid, $userInfo, $groupId, $image, $options=array()){

        $data = array();
        
        $data['uid'] = $uid;
        $data['user_info'] = $userInfo;
        $data['group_id'] = $groupId;
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request($this->userAddUrl, $data);
    }

    /**
     * 人脸更新接口
     *
     * @param string $uid - 用户id（由数字、字母、下划线组成），长度限制128B
     * @param string $userInfo - 用户资料，长度限制256B
     * @param string $groupId - 更新指定groupid下uid对应的信息
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   action_type 目前仅支持replace，uid不存在时，不报错，会自动变为注册操作；未选择该参数时，如果uid不存在会提示错误
     * @return array
     */
    public function updateUser($uid, $userInfo, $groupId, $image, $options=array()){

        $data = array();
        
        $data['uid'] = $uid;
        $data['user_info'] = $userInfo;
        $data['group_id'] = $groupId;
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request($this->userUpdateUrl, $data);
    }

    /**
     * 人脸删除接口
     *
     * @param string $uid - 用户id（由数字、字母、下划线组成），长度限制128B
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   group_id 删除指定groupid下uid对应的信息
     * @return array
     */
    public function deleteUser($uid, $options=array()){

        $data = array();
        
        $data['uid'] = $uid;

        $data = array_merge($data, $options);

        return $this->request($this->userDeleteUrl, $data);
    }

    /**
     * 用户信息查询接口
     *
     * @param string $uid - 用户id（由数字、字母、下划线组成），长度限制128B
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   group_id 选择指定group_id则只查找group列表下的uid内容，如果不指定则查找所有group下对应uid的信息
     * @return array
     */
    public function getUser($uid, $options=array()){

        $data = array();
        
        $data['uid'] = $uid;

        $data = array_merge($data, $options);

        return $this->request($this->userGetUrl, $data);
    }

    /**
     * 组列表查询接口
     *
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   start 默认值0，起始序号
     *   num 返回数量，默认值100，最大值1000
     * @return array
     */
    public function getGroupList($options=array()){

        $data = array();
        

        $data = array_merge($data, $options);

        return $this->request($this->groupGetlistUrl, $data);
    }

    /**
     * 组内用户列表查询接口
     *
     * @param string $groupId - 用户组id（由数字、字母、下划线组成），长度限制128B
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   start 默认值0，起始序号
     *   num 返回数量，默认值100，最大值1000
     * @return array
     */
    public function getGroupUsers($groupId, $options=array()){

        $data = array();
        
        $data['group_id'] = $groupId;

        $data = array_merge($data, $options);

        return $this->request($this->groupGetusersUrl, $data);
    }

    /**
     * 组间复制用户接口
     *
     * @param string $srcGroupId - 从指定group里复制信息
     * @param string $groupId - 用户组id，标识一组用户（由数字、字母、下划线组成），长度限制128B。如果需要将一个uid注册到多个group下，group\_id需要用多个逗号分隔，每个group_id长度限制为48个英文字符。**注：group无需单独创建，注册用户时则会自动创建group。**<br>**产品建议**：根据您的业务需求，可以将需要注册的用户，按照业务划分，分配到不同的group下，例如按照会员手机尾号作为groupid，用于刷脸支付、会员计费消费等，这样可以尽可能控制每个group下的用户数与人脸数，提升检索的准确率
     * @param string $uid - 用户id（由数字、字母、下划线组成），长度限制128B
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     */
    public function addGroupUser($srcGroupId, $groupId, $uid, $options=array()){

        $data = array();
        
        $data['src_group_id'] = $srcGroupId;
        $data['group_id'] = $groupId;
        $data['uid'] = $uid;

        $data = array_merge($data, $options);

        return $this->request($this->groupAdduserUrl, $data);
    }

    /**
     * 组内删除用户接口
     *
     * @param string $groupId - 用户组id，标识一组用户（由数字、字母、下划线组成），长度限制128B。如果需要将一个uid注册到多个group下，group\_id需要用多个逗号分隔，每个group_id长度限制为48个英文字符。**注：group无需单独创建，注册用户时则会自动创建group。**<br>**产品建议**：根据您的业务需求，可以将需要注册的用户，按照业务划分，分配到不同的group下，例如按照会员手机尾号作为groupid，用于刷脸支付、会员计费消费等，这样可以尽可能控制每个group下的用户数与人脸数，提升检索的准确率
     * @param string $uid - 用户id（由数字、字母、下划线组成），长度限制128B
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     * @return array
     */
    public function deleteGroupUser($groupId, $uid, $options=array()){

        $data = array();
        
        $data['group_id'] = $groupId;
        $data['uid'] = $uid;

        $data = array_merge($data, $options);

        return $this->request($this->groupDeleteuserUrl, $data);
    }

    /**
     * 身份验证接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param string $idCardNumber - 身份证号（真实身份证号号码）。我们的服务端会做格式校验，并通过错误码返回，但是为了您的产品反馈体验更及时，建议在产品前端做一下号码格式校验与反馈
     * @param string $name - utf8，姓名（真实姓名，和身份证号匹配）
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   quality 判断图片中的人脸质量是否符合条件。use表示需要做质量控制，质量不符合条件的照片会被直接拒绝
     *   quality_conf 人脸质量检测中每一项指标的具体阈值设定，json串形式，当指定quality:use时生效
     *   faceliveness 判断活体值是否达标。use表示需要做活体检测，低于活体阈值的照片会直接拒绝
     *   faceliveness_conf 人脸活体检测的阈值设定，json串形式，当指定faceliveness:use时生效。默认使用的阈值如下：{faceliveness：0.834963}
     *   ext_fields 可选项为faceliveness，qualities。选择具体的项，则返回参数中将会显示相应的扩展字段。如faceliveness表示返回结果中包含活体相关内容，qualities表示返回结果中包含质量检测相关内容
     * @return array
     */
    public function personVerify($image, $idCardNumber, $name, $options=array()){

        $data = array();
        
        $data['image'] = base64_encode($image);
        $data['id_card_number'] = $idCardNumber;
        $data['name'] = $name;

        $data = array_merge($data, $options);

        return $this->request($this->personVerifyUrl, $data);
    }

    /**
     * 在线活体检测接口
     *
     * @param string $image - 图像数据，base64编码，要求base64编码后大小不超过4M，最短边至少15px，最长边最大4096px,支持jpg/png/bmp格式
     * @param array $options - 可选参数对象，key: value都为string类型
     * @description options列表:
     *   max_face_num 最多处理人脸数目，默认值1
     *   face_fields 如不选择此项，返回结果默认只有人脸框、概率和旋转角度。可选参数为qualities、faceliveness。qualities：图片质量相关判断；faceliveness：活体判断。如果两个参数都需要选择，请使用半角逗号分隔。
     * @return array
     */
    public function faceverify($image, $options=array()){

        $data = array();
        
        $data['image'] = base64_encode($image);

        $data = array_merge($data, $options);

        return $this->request($this->faceverifyUrl, $data);
    }
}