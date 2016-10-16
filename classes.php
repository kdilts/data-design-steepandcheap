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
	 * @param $newUserName string $newUser
	 * @param $newUserHash string $newUser
	 * @param $newUserSalt string $newUser
	 * @param $newUserAddress string $newUser
	 * @param $newUserEmail string $newUser
	 */
	public function __construct($newUserId, $newUserName, $newUserHash, $newUserSalt, $newUserAddress, $newUserEmail) {
	}
}

?>