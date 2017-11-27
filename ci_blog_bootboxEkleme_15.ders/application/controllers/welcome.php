<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

//sınıfımızın yapıcı fonksiyonu
	public function __construct()
    {
    	//ilk önce üst sınıfın yapıcı fonksiyonu çağrılır
        parent::__construct();
        //model sınıfımızı yüklüyoruz.
        $this->load->model("kullanici_model");

    }	
	public function index()
	{
		//url ye controlerımızn ismi yazıldığında ilk olarak index  metodu çağrılır.
    //bir standat sınıf nesnesi oluşturup mddelden gelen değerleri atıyoruz.
    $data=new stdClass();
    $data->kullnaicilar=$this->kullanici_model->getAll();


    //viewimizi çağırıp modelden gelen değerleri viewimize gönderiyoruz
		$this->load->view('welcome_message',$data);
	}

   public function add_Kullanici(){

        	$ad=$this->input->post("kullanici_adi");
        	$soyad=$this->input->post("kullanici_soyadi");

//gelen verileri bir diziye aktarıyoruz "k_ad","k_soyad" veritabanımızdaki kolon adları
        	$data=array("k_ad" => $ad ,

                    "k_soyad" => $soyad 
        	 );

//aldığımız değerleri kayıt için model sınıfımızın insert metodunu çağırıyoruz 
//gelen sonucu bir değişkene atıyoruz.
       $insert=$this->kullanici_model->insert($data);

//insert başarılı ise gerçekleşmişse viewimizi çağırıyoruz
      if($insert){
          $this->load->view("kullanici");
         }
        }

        public function delete_kullanici($id){

//ilk olarak silinecek kullanıcı id isne göre kullanıcıyı getiriyoruz
      $kullanici = $this->kullanici_model->get(array("id" => $id));
//kullanıcının resminin url sini alıyoruz
    $file_name = FCPATH ."resim/$kullanici->resim_url";
//resmmi unlink ile kaldırıyoruz
    if(unlink($file_name)){
//eğer resim dosyadan silindi ise veritabanından resmi siliyoruz
     
        $delete=$this->kullanici_model->delete(array("id"=>$id));
//veritabanından silme işlemi başarıle ile gerçekleştirilirse
if($delete){
       //gelen verileri tutacak sınıf nesnesi üretiyoruz
            $data=new stdClass();
            //gelen verileri nesnemize atıyoruz
           $data->kullnaicilar=$this->kullanici_model->getAll();
           //view i çağırıp gelen verileri view e gönderiyoruz
              $this->load->view('welcome_message',$data);
}
      
    }     

        }
            public function update_kullaniciPage($id){
              //güncelleyeceğimiz kişinini bilhgilerini tutmak için nesne oluşutruyoruz
              $data=new stdClass();

        //id sini bildiğimiz kişinini bilgileri getiriyoruz
            $data->kullnaicilar=$this->kullanici_model->get(array("id"=>$id));
      //aldığımız bilgileri güncelleme sayfasını yükleyip bilgileri view e gönderiyoruz
              $this->load->view('kullanici_guncellePage',$data);

            }

         public function update_kullanici($id){


          $ad=$this->input->post("kullanici_adi");
          $soyad=$this->input->post("kullanici_soyadi");

//gelen verileri bir diziye aktarıyoruz "k_ad","k_soyad" veritabanımızdaki kolon adları
          $data=array("k_ad" => $ad ,

                    "k_soyad" => $soyad 
           );


          $update=$this->kullanici_model->update(array("id"=>$id),$data);

//UPDATE işlemi başarılı ise kullanıcıları çekip viewimizi çağırıyoruz
           if($update){
            //gelen verileri tutacak sınıf nesnesi üretiyoruz
            $data=new stdClass();
            //gelen verileri nesnemize atıyoruz
           $data->kullnaicilar=$this->kullanici_model->getAll();
           //view i çağırıp gelen verileri view e gönderiyoruz
              $this->load->view('welcome_message',$data);

            }

        }


        public function newresim($id){

            $data["id"] =$id;
            $this->load->view("new_resim",$data);

                  }


        public function add($id){

                //resim ekleneceği klasör
                   $config['upload_path']          = 'resim/';
                //eklenecek resimin tipi
                $config['allowed_types']        = 'gif|jpg|png';
                //ekleme işleminde resmin adını şifreli bir şekilde kaydetmek için
                  $config['encrypt_name']     = true;

                //upload kütüphanesini oluşturduğumuz confige göre yüklüyoruz
                $this->load->library('upload', $config);

//dosya yükleme işlemini yapıyoruz
                if ( ! $this->upload->do_upload("resim"))
                {
                  //eğer yükleme işlemi başarısız olursa 
                  //hata dizimizi oluşturuyoz ve hatamızı alıyoruz
                        $error = array('error' => $this->upload->display_errors());
                  //hataları yazdırıyotuz
                     print_r($error);
                }
                else{

    //resim yükleme işlemi başarılı olursa
     //yüklenen resmin blgilerini alıyoruz
              $data = array('upload_data' =>$this->upload->data());
              //yüklenen resmin adını alıyoruz
              $img_id = $data["upload_data"]['file_name'];

             //veri tabanına yükleme işlemi yapmak için gerekli bilgilerin olduğu diziyi oluşturuyoruz
              $date=array(
              "resim_ad"=>$_FILES["resim"]['name'],
              "resim_url"=>$img_id

                 );

//veritabanında kişinin resim bilgilerini güncellemek için metodumuzu çağırıyoruz.
                 $result=$this->kullanici_model->update(array("id"=>$id),$date);

//veritabanında güncelleme işlemi başarılı ise
                if($result){
                  //controlerımızın adını yazıp yönlendirme yapıyoruz
                 redirect("welcome");

                           }
                      else{
                //yükleme işlmei başarısız ise tekrar resim seçme sayfasını çağırıyoruz    
                   redirect("welcome/newresim/$id");

                         }



}
}

}


?>

