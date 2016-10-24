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

	/**
	 * inserts this product into mySQL
	 * @param \PDO $pdo
	 * @throws \PDOException
	 * @throws \TypeError
	 */
	public function insert(\PDO $pdo){
		// enforce productId is null - don't insert product that already exists
		if($this->productId !== null){
			throw new \PDOException("not a new product");
		}

		// create query template
		$query = "INSERT INTO product(productId, productName, productPrice, productImgPath, productSpecifications) VALUES (:productId, :productName, :productPrice, :productImgPath, :productSpecifications)";
		$statement = $pdo->prepare($query);

		// bind variables to the placeholders in template
		$parameters = [
			"productId" => $this->productId,
			"productName" => $this->productName,
			"productPrice" => $this->productPrice,
			"productImgPath" => $this->productImgPath,
			"productSpecifications" => $this->productSpecifications
		];
		$statement->execute($parameters);

		// update null productId with what mySQL just gave us
		$this->productId = intval($pdo->lastInsertId());
	}

	/**
	 * deletes product from mySQL
	 * @param \PDO $pdo
	 * @throws \PDOException
	 * @throws \TypeError
	 */
	public function delete(\PDO $pdo){
		// enforce productId not null - don't delete product that does not exist
		if($this->productId === null){
			throw new \PDOException("unable to delete product that does not exist");
		}

		// create query template
		$query = "DELETE FROM product WHERE productId = :productId";
		$statement = $pdo->prepare($query);

		// bind variables to the placeholders in template
		$parameters = ["productId" => $this->productId];
		$statement->execute($parameters);
	}

	/**
	 * updates product in mySQL
	 * @param \PDO $pdo
	 */
	public function update(\PDO $pdo){
		// enforce productId not null - don't delete product that does not exist
		if($this->productId === null){
			throw new \PDOException("unable to update product that does not exist");
		}

		// create query template
		$query = "UPDATE product SET productId = :productId, productName = :productName";
		$statement = $pdo->prepare($query);

		// bind variables to placeholder in template
		$parameters = [
			"productId" => $this->productId,
			"productName" => $this->productName,
			"productPrice" => $this->productPrice,
			"productImgPath" => $this->productImgPath,
			"productSpecifications" => $this->productSpecifications
		];
		$statement->execute($parameters);
	}

	/**
	 * get product by productId
	 * @param \PDO $pdo
	 * @param string $productId
	 * @return Product|null
	 * @throws \PDOException
	 * @throws \TypeError
	 */
	public static function getProductById(\PDO $pdo, string $productId){
		// sanitize id before searching
		if($productId <= 0){
			throw new \PDOException("product id must be positive");
		}

		// create query template
		$query = "SELECT productId, productName, productPrice, productImgPath, productSpecifications FROM product WHERE productId LIKE :productId";
		$statement = $pdo->prepare($query);

		// bind the product id to the place holder in the template
		$parameters = ["productId" => $productId];
		$statement->execute($parameters);

		// grab the product from mySQL
		try{
			$product = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false){
				$product = new Product(
					$row["productId"],
					$row["productName"],
					$row["productPrice"],
					$row["productImgPath"],
					$row["productSpecifications"]
				);
			}
		} catch (\Exception $exception){
			// if row couldn't be converted, rethrow it
			throw (new \PDOException($exception->getMessage(), 0, $exception));
		}

		return($product);
	}

	/**
	 * returns a product by productName
	 * @param \PDO $pdo
	 * @param string $productName
	 * @return \SplFixedArray
	 * @throws \PDOException
	 * @throws \TypeError
	 */
	public static function getProductByName(\PDO $pdo, string $productName){
		// sanitize productName before searching
		$productName = trim($productName);
		$productName = filter_var($productName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($productName) === true){
			throw (new \PDOException("product name is invalid"));
		}
		// create query template
		$query = "SELECT productId, productName, productPrice, productImgPath, productSpecifications FROM product WHERE productName LIKE :productName";
		$statement = $pdo->prepare($query);
		// bind productName to placeholder in template
		$productName = "%$productName%";
		$parameters = ["productName" => $productName];
		$statement->execute($parameters);
		// build array of products
		$products = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$product = new Product(
					$row["productId"],
					$row["productName"],
					$row["productPrice"],
					$row["productImgPath"],
					$row["productSpecifications"]
				);
				$products[$products->key()] = $product;
				$products->next();
			} catch(\Exception $exception) {
				// if row couldn't be converted rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($products);
	}

	/**
	 * returns a product by productPrice
	 * @param \PDO $pdo
	 * @param float $productPrice
	 * @return \SplFixedArray
	 * @throws \PDOException
	 * @throws \TypeError
	 */
	public static function getProductByPrice(\PDO $pdo, float $productPrice){
		// sanitize productName before searching
		if($productPrice <= 0){
			throw new \PDOException("product price must be positive");
		}

		// create query template
		$query = "SELECT productId, productName, productPrice, productImgPath, productSpecifications FROM product WHERE productName LIKE :productName";
		$statement = $pdo->prepare($query);

		// bind productName to placeholder in template
		$productPrice = "%$productPrice%";
		$parameters = ["productPrice" => $productPrice];
		$statement->execute($parameters);

		// build array of products
		$products = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$product = new Product(
					$row["productId"],
					$row["productName"],
					$row["productPrice"],
					$row["productImgPath"],
					$row["productSpecifications"]
				);
				$products[$products->key()] = $product;
				$products->next();
			} catch(\Exception $exception) {
				// if row couldn't be converted rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}

		return($products);
	}

	public static function getProductByImgPath(\PDO $pdo, string $productImgPath){
		// sanitize productImgPath before searching
		$productImgPath = trim($productImgPath);
		$productImgPath = filter_var($productImgPath, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($productImgPath) === true){
			throw (new \PDOException("product name is invalid"));
		}
		// create query template
		$query = "SELECT productId, productName, productPrice, productImgPath, productSpecifications FROM product WHERE productImgPath LIKE :productImgPath";
		$statement = $pdo->prepare($query);
		// bind productImgPath to placeholder in template
		$productImgPath = "%$productImgPath%";
		$parameters = ["productImgPath" => $productImgPath];
		$statement->execute($parameters);
		// build array of products
		$products = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$product = new Product(
					$row["productId"],
					$row["productName"],
					$row["productPrice"],
					$row["productImgPath"],
					$row["productSpecifications"]
				);
				$products[$products->key()] = $product;
				$products->next();
			} catch(\Exception $exception) {
				// if row couldn't be converted rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($products);
	}

	public static function getProductBySpecifications(\PDO $pdo, string $productSpecifications){
		// sanitize productSpecifications before searching
		$productSpecifications = trim($productSpecifications);
		$productSpecifications = filter_var($productSpecifications, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($productSpecifications) === true){
			throw (new \PDOException("product name is invalid"));
		}
		// create query template
		$query = "SELECT productId, productName, productPrice, productImgPath, productSpecifications FROM product WHERE productSpecifications LIKE :productSpecifications";
		$statement = $pdo->prepare($query);
		// bind productSpecifications to placeholder in template
		$productSpecifications = "%$productSpecifications%";
		$parameters = ["productSpecifications" => $productSpecifications];
		$statement->execute($parameters);
		// build array of products
		$products = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$product = new Product(
					$row["productId"],
					$row["productName"],
					$row["productPrice"],
					$row["productImgPath"],
					$row["productSpecifications"]
				);
				$products[$products->key()] = $product;
				$products->next();
			} catch(\Exception $exception) {
				// if row couldn't be converted rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($products);
	}
}