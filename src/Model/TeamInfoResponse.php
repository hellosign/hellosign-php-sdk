<?php
/**
 * TeamInfoResponse
 *
 * PHP version 7.3
 *
 * @category Class
 * @author   OpenAPI Generator team
 * @see     https://openapi-generator.tech
 */

/**
 * HelloSign API
 *
 * HelloSign v3 API
 *
 * The version of the OpenAPI document: 3.0.0
 * Contact: apisupport@hellosign.com
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 5.3.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace HelloSignSDK\Model;

use ArrayAccess;
use HelloSignSDK\ObjectSerializer;
use JsonSerializable;
use ReturnTypeWillChange;

/**
 * TeamInfoResponse Class Doc Comment
 *
 * @category Class
 * @author   OpenAPI Generator team
 * @see     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 * @internal This class should not be instantiated directly
 */
class TeamInfoResponse implements ModelInterface, ArrayAccess, JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'TeamInfoResponse';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'team_id' => 'string',
        'team_parent' => '\HelloSignSDK\Model\TeamParentResponse',
        'name' => 'string',
        'num_members' => 'int',
        'num_sub_teams' => 'int',
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'team_id' => null,
        'team_parent' => null,
        'name' => null,
        'num_members' => null,
        'num_sub_teams' => null,
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'team_id' => 'team_id',
        'team_parent' => 'team_parent',
        'name' => 'name',
        'num_members' => 'num_members',
        'num_sub_teams' => 'num_sub_teams',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'team_id' => 'setTeamId',
        'team_parent' => 'setTeamParent',
        'name' => 'setName',
        'num_members' => 'setNumMembers',
        'num_sub_teams' => 'setNumSubTeams',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'team_id' => 'getTeamId',
        'team_parent' => 'getTeamParent',
        'name' => 'getName',
        'num_members' => 'getNumMembers',
        'num_sub_teams' => 'getNumSubTeams',
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }

    /**
     * Associative array for storing property values
     *
     * @var array
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param array|null $data Associated array of property values
     *                         initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['team_id'] = $data['team_id'] ?? null;
        $this->container['team_parent'] = $data['team_parent'] ?? null;
        $this->container['name'] = $data['name'] ?? null;
        $this->container['num_members'] = $data['num_members'] ?? null;
        $this->container['num_sub_teams'] = $data['num_sub_teams'] ?? null;
    }

    public static function fromArray(array $data): TeamInfoResponse
    {
        /** @var TeamInfoResponse $obj */
        $obj = ObjectSerializer::deserialize(
            ObjectSerializer::instantiateFiles(static::class, $data),
            TeamInfoResponse::class,
        );

        return $obj;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }

    /**
     * Gets team_id
     *
     * @return string|null
     */
    public function getTeamId()
    {
        return $this->container['team_id'];
    }

    /**
     * Sets team_id
     *
     * @param string|null $team_id The id of a team
     *
     * @return self
     */
    public function setTeamId(?string $team_id)
    {
        $this->container['team_id'] = $team_id;

        return $this;
    }

    /**
     * Gets team_parent
     *
     * @return TeamParentResponse|null
     */
    public function getTeamParent()
    {
        return $this->container['team_parent'];
    }

    /**
     * Sets team_parent
     *
     * @param TeamParentResponse|null $team_parent team_parent
     *
     * @return self
     */
    public function setTeamParent(?TeamParentResponse $team_parent)
    {
        $this->container['team_parent'] = $team_parent;

        return $this;
    }

    /**
     * Gets name
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string|null $name The name of a team
     *
     * @return self
     */
    public function setName(?string $name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets num_members
     *
     * @return int|null
     */
    public function getNumMembers()
    {
        return $this->container['num_members'];
    }

    /**
     * Sets num_members
     *
     * @param int|null $num_members Number of members within a team
     *
     * @return self
     */
    public function setNumMembers(?int $num_members)
    {
        $this->container['num_members'] = $num_members;

        return $this;
    }

    /**
     * Gets num_sub_teams
     *
     * @return int|null
     */
    public function getNumSubTeams()
    {
        return $this->container['num_sub_teams'];
    }

    /**
     * Sets num_sub_teams
     *
     * @param int|null $num_sub_teams Number of sub teams within a team
     *
     * @return self
     */
    public function setNumSubTeams(?int $num_sub_teams)
    {
        $this->container['num_sub_teams'] = $num_sub_teams;

        return $this;
    }

    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param mixed $offset Offset
     *
     * @return bool
     */
    #[ReturnTypeWillChange]
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param mixed $offset Offset
     *
     * @return mixed|null
     */
    #[ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param mixed $offset Offset
     * @param mixed $value Value to be set
     *
     * @return void
     */
    #[ReturnTypeWillChange]
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param mixed $offset Offset
     *
     * @return void
     */
    #[ReturnTypeWillChange]
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @see https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return scalar|object|array|null returns data which can be serialized by json_encode(), which is a value
     *                                  of any type other than a resource
     */
    #[ReturnTypeWillChange]
    public function jsonSerialize()
    {
        return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_UNESCAPED_SLASHES
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}
