<?php

    /**
     * @package CThumbCreator
     * @author Lucas Padilha Gois <raziel.lpg@gmail.com>
     */
    class CThumbCreator extends CApplicationComponent
    {

        /**
         *
         * @var int largura da imagem
         */
        public $width = 200;

        /**
         *
         * @var int altura da imagem
         */
        public $height = 200;

        /**
         *
         * @var string pasta onde será salvo as miniaturas
         */
        public $directory;

        /**
         *
         * @var string nome padrão das miniaturas
         */
        public $defaultName = "thumb";

        /**
         *
         * @var string sufixo para o nome
         */
        public $suffix;

        /**
         *
         * @var string prefixo para o nome
         */
        public $prefix;

        /**
         *
         * @var mixed imagem a ser redimensionada
         */
        public $image;

        /**
         *
         * @var int qualidade da imagem
         */
        public $quality = 75;

        /**
         *
         * @var int taxa de conversao para arquivos png
         */
        public $compression = 6;

        /**
         *
         * @var int Posicao para recortar a imagem no eixo X
         */
        public $posX = 0;

        /**
         *
         * @var int Posicao para recortar a imagem no eixo Y
         */
        public $posY = 0;

        /**
         *
         * @var int Largura do recorte
         */
        public $cutWidth;

        /**
         *
         * @var int Altura do recorte
         */
        public $cutHeight;

        /**
         *
         * @var bool Indica se deve alinhar o recorte ao centro da imagem
         */
        public $cutCenter = false;

        /**
         *
         * @var int Distancia esquerda do recorte
         */
        public $distX = 0;

        /**
         *
         * @var int Distancia direita do recorte
         */
        public $distY = 0;

        /**
         *
         * @var array dimensoes e tipo da imagem
         */
        private $image_info;

        /**
         *
         * @var string extensao da imagem
         */
        private $ext;


        /**
         *
         * @var mixed variavel que armazenará a imagem
         */
        private $img;

        /**
         *
         * @var mixed variável que armazenará a imagem temporária
         */
        private $tmp;

        /**
         *
         * @var bool flag indicando se deve ser gerado um quadrado preto em volta das miniaturas
         */
        public $square = false;

        public function init() {
             
            if(!function_exists("imagecreatetruecolor")) {
               throw new Exception("Voce precisa habilitar a biblioteca GD para usar essa classe",500);
            }
            parent::init();
        }

        private function createImg() {
            if(!$this->image) {
                throw new Exception("Nome da imagem deve ser informado", 500);
            }

            $this->image_info = getimagesize($this->image);
            $this->ext = strtolower(end(explode("/",$this->image_info["mime"])));

            switch ($this->ext)
            {
                case "jpg":
                    $this->img = imagecreatefromjpeg($this->image);
                    break;
                case "jpeg":
                    $this->img = imagecreatefromjpeg($this->image);
                    break;
                case "gif":
                    $this->img = imagecreatefromgif($this->image);
                    break;
                case "png":
                    $this->img = imagecreatefrompng($this->image);
                    break;
                default:
                    throw new Exception("Tipo de imagem nao suportado",500);
            }
        }

        private function updateDimensions($width,$height)
        {
            $this->image_info[0] = $width;
            $this->image_info[1] = $height;
        }

        public function createThumb() {

            if(!$this->tmp)
            {
                $this->createImg();
            } else {
                $this->img = $this->tmp;
            }

            $dimension = min($this->width/$this->image_info[0],$this->height/$this->image_info[1]);

            if($dimension < 1)
            {
                $newDimension[0] = floor($dimension * $this->image_info[0]);
                $newDimension[1] = floor($dimension * $this->image_info[1]);
            } else {
                $newDimension[0] = $this->image_info[0];
                $newDimension[1] = $this->image_info[1];
            }

            if($this->square)
            {
                $this->tmp = imagecreatetruecolor($this->width, $this->height);
                imagefilledrectangle($this->tmp, 0, 0, $this->width-1, $this->height-1, 0);
                if(imagecopyresampled($this->tmp, $this->img, ($this->width-$newDimension[0])/2, ($this->height - $newDimension[1])/2, 0, 0, $newDimension[0], $newDimension[1], $this->image_info[0], $this->image_info[1]))
                {
                    $this->updateDimensions($newDimension[0], $newDimension[1]);
                } else {
                    throw new Exception("Problema ao criar a miniatura",500);
                }
            } else {
                $this->tmp = imagecreatetruecolor($newDimension[0], $newDimension[1]);
                if(imagecopyresampled($this->tmp, $this->img, 0, 0, 0, 0, $newDimension[0], $newDimension[1], $this->image_info[0], $this->image_info[1]))
                {
                    $this->updateDimensions($newDimension[0], $newDimension[1]);
                } else {
                    throw new Exception("Problema ao criar a miniatura",500);
                }
            }
 
        }


        public function cut()
        {

            if(!$this->width || !$this->height) {
                throw new Exception("Por favor, informe uma largura e altura para a imagem", 500);
            }

            if(!$this->cutWidth) {
                $this->cutWidth = $this->width;
            }

            if(!$this->cutHeight) {
                $this->cutHeight = $this->height;
            }

            if($this->cutCenter)
            {
                $this->distX = ($this->cutpWidth - $this->width)/2;
                $this->distY = ($this->cutpHeight - $this->height)/2;
            }

            if(!$this->tmp)
            {
                $this->createImg();
            } else {
                $this->img = $this->tmp;
            }
            
            $this->tmp = imagecreatetruecolor($this->cutWidth,$this->cutHeight);
            if(imagecopyresampled($this->tmp, $this->img, $this->distX,$this->distY,$this->posX,$this->posY,$this->width,$this->height,$this->width,$this->height))
            {
                $this->updateDimensions($this->cutWidth,$this->cutHeight);
            } else {
                throw new Exception("Problema ao recortar a imagem", 500);
            }


        }



        public function save()
        {
            if(!$this->directory) {
                throw new Exception("Informe o diretorio para salvar as miniaturas",500);
            }
            
            switch ($this->ext)
            {
                case "jpg":
                    imagejpeg($this->tmp,$this->directory . $this->prefix . $this->defaultName . $this->suffix . "." . $this->ext,$this->quality);
                    break;
                case "jpeg":
                    imagejpeg($this->tmp,$this->directory . $this->prefix . $this->defaultName . $this->suffix . "." . $this->ext,$this->quality);
                    break;
                case "gif":
                   imagegif($this->tmp,$this->directory . $this->prefix . $this->defaultName . $this->suffix . "." . $this->ext,$this->quality);
                    break;
                case "png":
                    imagepng($this->tmp,$this->directory . $this->prefix . $this->defaultName . $this->suffix . "." . $this->ext,$this->compression);
                    break;
            }


        }

        public function show()
        {
            header("content-type:" . $this->image_info['mime']);
            switch ($this->ext)
            {
                case "jpg":
                    imagejpeg($this->tmp);
                    break;
                case "jpeg":
                    imagejpeg($this->tmp);
                    break;
                case "gif":
                    imagegif($this->tmp);
                    break;
                case "png":
                    imagepng($this->tmp);
                    break;
            }
        }

        function __destruct()
        {
            imagedestroy($this->tmp);
            imagedestroy($this->img);
        }

        
    }
?>