<?php 
    class Rumus extends CI_Controller {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('M_rumus');
            $this->load->helper('url');
        }

        public function rumus()
        {   
            $data['hasil'] = $this->M_rumus->viewALL();
            $this->load->view("admin/_template/head.php");
            $this->load->view("admin/_template/navbar.php");
            $this->load->view("admin/v_dta_rumus", $data);
            $this->load->view("admin/_template/footer.php");
            $this->load->view("admin/_template/scrolltop.php");
            $this->load->view("admin/_template/modal.php");
            $this->load->view("admin/_template/js.php");
        }

        public function tbhrms()
        {
            $data['kategori']=$this->M_rumus->getKategori(); 
            $this->load->view("admin/_template/head.php");
            $this->load->view("admin/_template/navbar.php");
            $this->load->view("admin/v_tbhrms", $data);
            $this->load->view("admin/_template/footer.php");
            $this->load->view("admin/_template/scrolltop.php");
            $this->load->view("admin/_template/modal.php");
            $this->load->view("admin/_template/js.php");
        }

        public function inputrms(){
            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            $ktg = $this->input->post('ktg');
            $foto = $_FILES['rumus'];
            if($foto=''){

            }else{
                $config['upload_path'] = './upload/rumus';
                $config['allowed_types'] = 'jpg|png';

                $this->load->library('upload',$config);
                if(!$this->upload->do_upload('rumus')){
                    echo "Gagal Upload"; 
                    die();
                }else{
                    $foto=$this->upload->data('file_name');
                }
            }
     
            $data = array(
                'id_rms' => $id,
                'nama_rms' => $nama,
                'det_rms' => $foto,
                'id_kategori' => $ktg
                );
            $this->M_rumus->input_rms($data,'rumus_mm');
            redirect('admin/Rumus/rumus');
        }

        public function ubhrms($id){
            $where = array('id_rms' => $id);
            $data['rumus_mm'] = $this->M_rumus->ubh_rms($where,'rumus_mm')->result();
            $data['kategori']=$this->M_rumus->getKategori();
            $this->load->view("admin/_template/head.php");
            $this->load->view("admin/_template/navbar.php");
            $this->load->view("admin/v_uptrms",$data);
            $this->load->view("admin/_template/footer.php");
            $this->load->view("admin/_template/scrolltop.php");
            $this->load->view("admin/_template/modal.php");
            $this->load->view("admin/_template/js.php");
        }

        public function updaterms(){
            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            $ktg = $this->input->post('ktg');
            $foto = $this->input->post('rumus');
            if($foto=''){

            }else{
                $config['upload_path'] = './upload/rumus';
                $config['allowed_types'] = 'jpg|png';

                $this->load->library('upload',$config);
                if(!$this->upload->do_upload('rumus')){

                }else{
                    $foto=$this->upload->data('file_name');
                }
            }
        
            $data = array(
                'nama_rms' => $nama,
                'id_kategori' => $ktg,
                'det_rms' => $foto
            );
        
            $where = array(
                'id_rms' => $id
            );
            
            $this->M_rumus->update_rms($where,$data,'rumus_mm');
            redirect('admin/Rumus/rumus');
        }

        public function hapusrms($id){
            $where = array('id_rms' => $id);
            $this->M_rumus->delete_rms($where,'rumus_mm');
            redirect('admin/Rumus/rumus');
        }
    }
?>