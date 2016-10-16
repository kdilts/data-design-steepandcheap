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
	public function __construct($newUserId, $newUserName, $newUserHash, $newUserSalt, $newUserAddress, $newUserEmail) {
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
	public function getUserId(){ return $this->userId; }

	/**
	 * accessor method for user name
	 * @return string value of user name
	 */
	public function getUserName(){ return $this->userName; }

	/**
	 * accessor method for user hash
	 * @return string value of user hash
	 */
	public function getUserHash(){ return $this->userHash; }

	/**
	 * accessor method for user salt
	 * @return string value of user salt
	 */
	public function getUserSalt(){ return $this->userSalt; }

	/**
	 * accessor method for user address
	 * @return string value of user address
	 */
	public function getUserAddress(){ return $this->userAddress; }

	/**
	 * accessor method for user email
	 * @return string value of user email
	 */
	public function getUserEmail(){ return $this->userEmail; }

	/**
	 * mutator method for user id
	 * @param int $newUserId new value of user id
	 */
	public function setUserId($newUserId){}

	/**
	 * mutator method for user name
	 * @param string $newUserName new value of user name
	 */
	public function setUserName($newUserName){}

	/**
	 * mutator method for user hash
	 * @param string $newUserHash new value of user hash
	 */
	public function setUserHash($newUserHash){}

	/**
	 * mutator method for user salt
	 * @param string $newUserSalt new value of user salt
	 */
	public function setUserSalt($newUserSalt){}

	/**
	 * mutator method for user address
	 * @param string $newUserAddress new value of user address
	 */
	public function setUserAddress($newUserAddress){}

	/**
	 * mutator method for user email
	 * @param string $newUserEmail new value of user email
	 */
	public function setUserEmail($newUserEmail){}
}

?>