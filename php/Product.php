<?php
namespace Edu\Cnm\kdilts\DataDesign;

// require_once("autoload.php");

/**
 * @author Kevin Dilts <kdilts@cnm.edu>
 * @version 1.0.0
 */

class Product {
	/**
	 * id for this product. this is the primary key.
	 * @var int $productId
	 */
	private $productId;

	/**
	 * name for this product.
	 * @var string $productName
	 */
	private $productName;

	/**
	 * price for this product.
	 * @var float $productPrice
	 */
	private $productPrice;

	/**
	 * image path for this product.
	 * @var string $productImgPath
	 */
	private $productImgPath;

	/**
	 * product specification text for this product.
	 * @var string $productSpecifications
	 */
	private $productSpecifications;


	/**
	 * Product constructor.
	 * @param int $newProductId id of this product
	 * @param string $newProductName name of this product
	 * @param float $newProductPrice price of this product
	 * @param string $newProductImgPath image path of this product
	 * @param string $newProductSpecifications specification text for this product
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 */
	public function __construct(int $newProductId, string $newProductName, float $newProductPrice, string $newProductImgPath, string $newProductSpecifications) {
		try {
			$this->setProductId($newProductId);
			$this->setProductName($newProductName);
			$this->setProductPrice($newProductPrice);
			$this->setProductImgPath($newProductImgPath);
			$this->setProductSpecifications($newProductSpecifications);
		} catch(\InvalidArgumentException $invalidArgumentException){
			// rethrow the exception to the caller
			throw (new \InvalidArgumentException($invalidArgumentException->getMessage(),0,$invalidArgumentException));
		} catch(\RangeException $rangeException){
			// rethrow the exception to the caller
			throw (new \RangeException($rangeException->getMessage(),0,$rangeException));
		} catch(\TypeError $typeError){
			// rethrow the exception to the caller
			throw (new \TypeError($typeError->getMessage(),0,$typeError));
		} catch(\Exception $exception){
			// rethrow the exception to the caller
			throw (new \Exception($exception->getMessage(),0,$exception));
		}
	}

	/** accessor method for product id
	 * @return int value of product id
	 */
	public function getProductId(){
		return $this->productId;
	}

	/** accessor method for product name
	 * @return string value of product name
	 */
	public function getProductName(){
		return $this->productName;
	}

	/** accessor method for product price
	 * @return float value of product price
	 */
	public function getProductPrice(){
		return $this->productPrice;
	}

	/** accessor method for product image path
	 * @return string value of product image path
	 */
	public function getProductImgPath(){
		return $this->productImgPath;
	}

	/** accessor method for product specifications
	 * @return string value of product specifications
	 */
	public function getProductSpecifications(){
		return $this->productSpecifications;
	}

	/** mutator method for product id
	 * @param int $newProductId new value of product id
	 * @throws \RangeException if $newProductId is not positive
	 * @throws \TypeError if $newProductId is not an integer
	 */
	public function setProductId(int $newProductId){
		// verify product id is positive
		if($newProductId <= 0){
			throw(new \RangeException("product id is not positive"));
		}

		// store the product id
		$this->productId = $newProductId;
	}

	/** mutator method for product name
	 * @param string $newProductName new value of product name
	 * @throws \InvalidArgumentException if $newProductName is insecure, or not a string
	 * @throws \RangeException if $newProductName is too long
	 * @throws \TypeError if $newProductName is not a string
	 */
	public function setProductName(string $newProductName){
		// verify that product name is secure
		$newProductName = trim($newProductName);
		$newProductName = filter_var($newProductName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProductName) === true){
			throw new \InvalidArgumentException("product name is empty or insecure");
		}

		// verify that product name will fit into database
		if(strlen($newProductName) > 20){
			throw(new \RangeException("product name too long"));
		}

		// store the product name
		$this->productName = $newProductName;
	}

	/** mutator method for product price
	 * @param float $newProductPrice
	 * @throws \RangeException if $newProductPrice is not positive
	 * @throws \TypeError if $newProductPrice is not a float
	 */
	public function setProductPrice(float $newProductPrice){
		// verify product price is positive
		if($newProductPrice <= 0){
			throw(new \RangeException("product price is not positive"));
		}

		// store the product price
		$this->productPrice = $newProductPrice;
	}

	/** mutator method for product image path
	 * @param string $newProductImgPath
	 * @throws \InvalidArgumentException if $newProductImgPath is insecure, or not a string
	 * @throws \RangeException if $newProductImgPath is too long
	 * @throws \TypeError if $newProductImgPath is not a string
	 */
	public function setProductImgPath(string $newProductImgPath){
		// verify that product name is secure
		$newProductImgPath = trim($newProductImgPath);
		$newProductImgPath = filter_var($newProductImgPath, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProductImgPath) === true){
			throw new \InvalidArgumentException("product image path is empty or insecure");
		}

		// verify that product name will fit into database
		if(strlen($newProductImgPath) > 80){
			throw(new \RangeException("product img path too long"));
		}

		// store the product img path
		$this->productImgPath = $newProductImgPath;
	}

	/** mutator method for product specification text
	 * @param string $newProductSpecifications
	 * @throws \InvalidArgumentException if $newProductSpecifications is insecure, or not a string
	 * @throws \RangeException if $newProductSpecifications is too long
	 * @throws \TypeError if $newProductSpecifications is not a string
	 */
	public function setProductSpecifications(string $newProductSpecifications){
		// verify that product name is secure
		$newProductSpecifications = trim($newProductSpecifications);
		$newProductSpecifications = filter_var($newProductSpecifications, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProductSpecifications) === true){
			throw new \InvalidArgumentException("product specification text is empty or insecure");
		}

		// store the product specifications
		$this->productSpecifications = $newProductSpecifications;
	}
}

?>