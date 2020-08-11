<?php
class Book_details_Model extends CI_Model 
{
    private $table = "book_details";
    public function __construct()
	{
        
	//call CodeIgniter's default Constructor
	parent::__construct();
	
    }
    
	function saverecords($book_details)
	{
        if($this->db->insert('book_details',$book_details)){
            return $result = array(
                'status'=> 201,
                'message'=> 'Book details saved successfully !'
            );
        }else{
            return $result = array(
                'status'=> 400,
                'message'=> 'Failed to save book details !'
            );
        }
    }

    function getcords($id="")
	{
        if($id!=""){
            $query = $this->db->get_where('book_details', array('id' => $id));
            $result_data = $query->result();
            if($query->num_rows() == 1){
                $row_count = $query->num_rows();
                $data = array('row_count'=>$row_count,'book_details'=>$result_data);
                return $result = array(
                    'status'=> 200,
                    'data'=> $data
                );
            }else{
                return $result = array(
                    'status'=> 400,
                    'message'=> 'currently no records available !'
                );
            }

        }else{
            $query = $this->db->get('book_details');
            $result_data = $query->result();
            if($query->num_rows() > 0){
                $row_count = $query->num_rows();
                $data = array('row_count'=>$row_count,'book_details'=>$result_data);
                return $result = array(
                    'status'=> 200,
                    'data'=> $data
                );
            }else{
                return $result = array(
                    'status'=> 400,
                    'message'=> 'currently no records available !'
                );
            }
        }    
    }

    function deleterecords($id){
        if($this->db->delete('book_details', array('id' => $id))){
            return $result = array(
                'status'=> 201,
                'message'=> 'Book details deleted successfully !'
            );
        }else{
            return $result = array(
                'status'=> 400,
                'message'=> 'Failed to delete book details !'
            );

        }
    }

    function update_book_details($id,$data){
        $this->db->where('id', $id);
        if($this->db->update('book_details', $data)){
            return $result = array(
                'status'=> 200,
                'message'=> 'Book details updated successfully !'
            );
        }else{
            return $result = array(
                'status'=> 400,
                'message'=> 'Failed to update book details !'
            );
        }
    }

    function listrecords($per_page,$offset,$serach_term=""){
        // echo $serach_term;die;
        if($serach_term!=""){
            $this->db->select('*');
            $this->db->from('book_details');
            $this->db->where('title', $serach_term, 'both');
            $this->db->limit($per_page,$offset);
            $query  = $this->db->get();
        }else{
            $query = $this->db->limit($per_page,$offset)->get('book_details');
        }
        
            $result_data = $query->result();
            if($query->num_rows() > 0){
                $row_count = $query->num_rows();
                $data = array('row_count'=>$row_count,'book_details'=>$result_data);
                return $result = array(
                    'status'=> 200,
                    'data'=> $data
                );
            }else{
                return $result = array(
                    'status'=> 400,
                    'message'=> 'currently no records available !'
                );
            }
    }

    function count($serach_term=""){
        if($serach_term!=""){
            $this->db->where('title', $serach_term, 'both');
        }
        return $this->db->count_all_results($this->table);
    }


    
}