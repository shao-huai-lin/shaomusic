<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Layout{
    
    var $obj;
    var $layout;
    
    public function __construct($config =array()){
        $layout = 'member';
        if(!empty($config) && isset($config['file'])){
            $layout = $config['file'];
        }
        $this->obj =& get_instance();
        $this->layout = '_layouts/' . $layout;
    }
    
    
    /**
     * @name:view
     * @description: 显示内容
     * @param: $view=模板路径，$data=传入数据,$return=是否返回数据
     * @author: Xiong Jianbang
     * @create: 2014-12-19 下午4:10:11
     **/
    public function view($view, $data=null, $return=false){
        $data['content_for_layout'] = $this->obj->load->view($view,$data,true);
        if($return){
            $output = $this->obj->load->view($this->layout,$data, true);
            return $output;
        }else{
            $this->obj->load->view($this->layout,$data, false);
        }
    }
}