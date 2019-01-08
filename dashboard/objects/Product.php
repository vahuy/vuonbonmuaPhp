<?php
class Product {
	private $id;
	private $name;
	private $image;
	private $price;
  	private $shortDescription;
  /*
   * called by Dog, Cat, Bird, etc.
   */
  public function __construct($aId, $aName, $aImage, $aPrice, $aShortDescription)
  {
    $this->id = $aId;
    $this->name = $aName;
    $this->image = $aImage;
    $this->price = $aPrice;
    $this->shortDescription = $aShortDescription;
  }

  /*
   * define the sorting rules - we will sort all Animals by name.
   */ 
  public static function getName() {
    return $this->name;
  }
  
  public static function getId() {
    return $this->name;
  }
  
  public static function getImage() {
    return $this->image;
  }

  /*
   * a String representation for all Animals.
   */
  public function __toString() {
    return "$this->name the $this->id goes $this->image";
  }
  
	public function generateHtml() {
		$currency = number_format($this->price)." vnđ<br>";
		return "
	        <div class='col-sm-6 col-md-3'>
	            <img src=$this->image alt=$this->name>
	            <h1>$currency</h1>
	            <p class='product-name'>$this->name</p>
	            <p>$this->shortDescription</p>
	        </div>";
	}
	
	public function formatCurrency($number) {
		return	number_format("1000000")." vnđ<br>";
	}
}
?>