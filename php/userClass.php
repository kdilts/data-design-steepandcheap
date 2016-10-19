<?php
namespace Edu\Cnm\kdilts\DataDesign;

// require_once("autoload.php");

/**
 * @author Kevin Dilts <kdilts@cnm.edu>
 * @version 1.0.0
 */
class User {
	/**
	 * id for this User; this is the primary key
	 * @var int $userId
	 */
	private $userId;

	/**
	 * username associated with user account
	 * @var string $userName
	 */
	private $userName;

	/**
	 * hash that encrypts user's password
	 * @var string $userHash
	 */
	private $userHash;

	/**
	 * salt added to user's password before hashing
	 * @var string $userSalt
	 */
	private $userSalt;

	/**
	 * physical address associated with user's account
	 * @var string $userAddress
	 */
	private $userAddress;

	/**
	 * email address associated with user's account
	 * @var string $userEmail
	 */
	private $userEmail;

	/**
	 * User constructor.
	 * @param $newUserId int $newUserId of this user
	 * @param $newUserName string $newUserName id of this user
	 * @param $newUserHash string $newUserHash hash for this user
	 * @param $newUserSalt string $newUserSalt salt for this user
	 * @param $newUserAddress string $newUserAddress physical address for this user
	 * @param $newUserEmail string $newUserEmail email address for this user
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 */
	public function __construct(int $newUserId, string $newUserName, string $newUserHash, string $newUserSalt, string $newUserAddress, string $newUserEmail) {
		try {
			$this->setUserId($newUserId);
			$this->setUserName($newUserName);
			$this->setUserHash($newUserHash);
			$this->setUserSalt($newUserSalt);
			$this->setUserAddress($newUserAddress);
			$this->setUserEmail($newUserEmail);
		} catch(\InvalidArgumentException $invalidArgument){
			// rethrow exception to caller
			throw(new \InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(\RangeException $range){
			// rethrow exception to caller
			throw(new \RangeException($range->getMessage(), 0, $range));
		} catch(\TypeError $typeError){
			// rethrow exception to caller
			throw(new \TypeError($typeError->getMessage(), 0, $typeError));
		} catch(\Exception $exception){
			// rethrow exception to caller
			throw(new \Exception($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for user id
	 * @return int value of user id
	 */
	public function getUserId(){
		return $this->userId;
	}

	/**
	 * accessor method for user name
	 * @return string value of user name
	 */
	public function getUserName(){
		return $this->userName;
	}

	/**
	 * accessor method for user hash
	 * @return string value of user hash
	 */
	public function getUserHash(){
		return $this->userHash;
	}

	/**
	 * accessor method for user salt
	 * @return string value of user salt
	 */
	public function getUserSalt(){
		return $this->userSalt;
	}

	/**
	 * accessor method for user address
	 * @return string value of user address
	 */
	public function getUserAddress(){
		return $this->userAddress;
	}

	/**
	 * accessor method for user email
	 * @return string value of user email
	 */
	public function getUserEmail(){
		return $this->userEmail;
	}

	/**
	 * mutator method for user id
	 * @param int $newUserId new value of user id
	 * @throws \RangeException if $newUserId is not positive
	 * @throws \TypeError if $newUserId is not an integer
	 */
	public function setUserId(int $newUserId){
		// verify the user id is positive
		if($newUserId <= 0){
			throw(new \RangeException("user id is not positive"));
		}

		// store the user id
		$this->userId = $newUserId;
	}

	/**
	 * mutator method for user name
	 * @param string $newUserName new value of user name
	 * @throws \InvalidArgumentException if $newUserName is not a string or insecure
	 * @throws \RangeException if $newUserName is > 20 characters
	 * @throws \TypeError if $newUserName is not a string
	 */
	public function setUserName(string $newUserName){
		// verify that user name is secure
		$newUserName = trim($newUserName);
		$newUserName = filter_var($newUserName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newUserName) === true){
			throw(new \InvalidArgumentException("user name is empty or insecure"));
		}

		// verify that user name will fit in the database
		if(strlen($newUserName) > 20){
			throw(new \RangeException("user name too long"));
		}

		// store the user name
		$this->userName = $newUserName;
	}

	/**
	 * mutator method for user hash
	 * @param string $newUserHash new value of user hash
	 * @throws \InvalidArgumentException if $newUserHash is not a string or insecure
	 * @throws \RangeException if $newUserHash is > 80 characters
	 * @throws \TypeError if $newUserHash is not a string
	 */
	public function setUserHash(string $newUserHash){
		// verify that user hash is secure
		$newUserHash = trim($newUserHash);
		$newUserHash = filter_var($newUserHash, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newUserHash) === true){
			throw(new \InvalidArgumentException("user hash is empty or insecure"));
		}

		// verify that user hash will fit in the database
		if(strlen($newUserHash) > 80){
			throw(new \RangeException("user hash too long"));
		}

		// store the user hash
		$this->userHash = $newUserHash;
	}

	/**
	 * mutator method for user salt
	 * @param string $newUserSalt new value of user salt
	 * @throws \InvalidArgumentException if $newUserSalt is not a string or insecure
	 * @throws \RangeException if $newUserSalt is > 20 characters
	 * @throws \TypeError if $newUserSalt is not a string
	 */
	public function setUserSalt(string $newUserSalt){
		// verify that user salt is secure
		$newUserSalt = trim($newUserSalt);
		$newUserSalt = filter_var($newUserSalt, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

		// verify that user salt will fit in the database
		if(strlen($newUserSalt) > 20){
			throw(new \RangeException("user salt too long"));
		}

		// store the user salt
		$this->userSalt = $newUserSalt;
	}

	/**
	 * mutator method for user address
	 * @param string $newUserAddress new value of user address
	 * @throws \InvalidArgumentException if $newUserAddress is not a string or insecure
	 * @throws \RangeException if $newUserAddress is > 1000 characters
	 * @throws \TypeError if $newUserAddress is not a string
	 */
	public function setUserAddress(string $newUserAddress){
		// verify that user address is secure
		$newUserAddress = trim($newUserAddress);
		$newUserAddress = filter_var($newUserAddress, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

		// verify that user address will fit in the database
		if(strlen($newUserAddress) > 1000){
			throw(new \RangeException("user address too long"));
		}

		// store the user address
		$this->userAddress = $newUserAddress;
	}

	/**
	 * mutator method for user email
	 * @param string $newUserEmail new value of user email
	 * @throws \InvalidArgumentException if $newUserEmail is not a string or insecure
	 * @throws \RangeException if $newUserEmail is > 100 characters
	 * @throws \TypeError if $newUserEmail is not a string
	 */
	public function setUserEmail(string $newUserEmail){
		// verify that user email is secure
		$newUserEmail = trim($newUserEmail);
		$newUserEmail = filter_var($newUserEmail, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

		// verify that user email will fit in the database
		if(strlen($newUserEmail) > 20){
			throw(new \RangeException("user email too long"));
		}

		// store the user email
		$this->userEmail = $newUserEmail;
	}
}

?>