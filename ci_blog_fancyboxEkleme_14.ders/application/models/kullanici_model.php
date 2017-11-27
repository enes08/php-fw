<?php 
class kullanici_model extends CI_Model
{
	//model yapıcı fonksiyonumuz
	public function __construct()
    {
        parent::__construct();

   // ekleme yapacağımız tablomuzun adını burda ekliyoruz
    //her defasında yazmıyalım diye
        $this->table = "kullanici";
       
    }

//veritabanına ekleme işlemini yaptığımız metotumuz
//parametre olarak bir array alıyor
    public function insert($data=array()){

//ilk parametre eklenecek tablo,ikincisi eklenecek data
    	$insert=$this->db->insert($this->table,$data);

    	return $insert;
    }

     public function getAll(){

//veri tabanımızdan kullanici adlı tablodan tüm sonuçları getiren sorgu
        $select=$this->db->get($this->table)->result();

        return $select;
    }

//id ye göre kullanıcı getiren metot 
 public function get($where=array()){

//kullanıcıyı getiren satır sadece tek satır döndürür
$row = $this->db->where($where)->get($this->table)->row();


        return $row;

    }
     public function delete($where=array()){

//veri tabanından parametre olarak gelen id deki kişiyi silen kısım
//delete metodunda ilk parametre tablo ismi diğeri where kısmı kisi neye göre silinecekse o biz gelen id değerine göre sileceğiz.

        $delete=$this->db->delete($this->table,$where);

        return $delete;
    }

       public function update($where=array(),$data){

    //veri tabanından parametre olarak gelen id deki kişiyi güncelleyen kısım
     $this->db->where($where);
     $update=$this->db->update($this->table, $data); 
        return $update;
    }




}
 ?>