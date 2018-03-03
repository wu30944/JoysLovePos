<?php
/**
 * Created by PhpStorm.
 * User: andywu
 * Date: 2018/1/26
 * Time: 下午10:11
 */
    namespace App\Repositories;

    use Illuminate\Http\Request;
    use App\Models\Flavor;
    use Validator;
    use Response;

    class FlavorRepository
    {
        private $FlavorRepository;

        public function __construct(Flavor $data)
        {
            $this->FlavorRepository=$data;
        }

        public function getAll()
        {
            return $this->FlavorRepository->all();
        }

        /*
         * 取得特定狀態的口味資料
         * */
        public function getStatusFlavor($status){
            return $this->FlavorRepository->whereIn('status',$status)->get();
        }



        public function save(Request $request)
        {

        }

        public function Create($OrderInfo){

            foreach($OrderInfo as $Order){
                foreach($Order as $item){

                }

            }
        }

        public function delete($id)
        {

        }

    }