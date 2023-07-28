<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Conversations\V1\Conversation;

use Twilio\Options;
use Twilio\Values;

/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 */
abstract class ParticipantOptions {
    /**
     * @param string $identity A unique string identifier for the conversation
     *                         participant as Chat User.
     * @param string $messagingBindingAddress The address of the participant's
     *                                        device.
     * @param string $messagingBindingProxyAddress The address of the Twilio phone
     *                                             number that the participant is
     *                                             in contact with.
     * @param \DateTime $dateCreated The date that this resource was created.
     * @param \DateTime $dateUpdated The date that this resource was last updated.
     * @param string $attributes An optional string metadata field you can use to
     *                           store any data you wish.
     * @param string $messagingBindingProjectedAddress The address of the Twilio
     *                                                 phone number that is used in
     *                                                 Group MMS.
     * @return CreateParticipantOptions Options builder
     */
    public static function create($identity = Values::NONE, $messagingBindingAddress = Values::NONE, $messagingBindingProxyAddress = Values::NONE, $dateCreated = Values::NONE, $dateUpdated = Values::NONE, $attributes = Values::NONE, $messagingBindingProjectedAddress = Values::NONE) {
        return new CreateParticipantOptions($identity, $messagingBindingAddress, $messagingBindingProxyAddress, $dateCreated, $dateUpdated, $attributes, $messagingBindingProjectedAddress);
    }

    /**
     * @param \DateTime $dateCreated The date that this resource was created.
     * @param \DateTime $dateUpdated The date that this resource was last updated.
     * @param string $attributes An optional string metadata field you can use to
     *                           store any data you wish.
     * @return UpdateParticipantOptions Options builder
     */
    public static function update($dateCreated = Values::NONE, $dateUpdated = Values::NONE, $attributes = Values::NONE) {
        return new UpdateParticipantOptions($dateCreated, $dateUpdated, $attributes);
    }
}

class CreateParticipantOptions extends Options {
    /**
     * @param string $identity A unique string identifier for the conversation
     *                         participant as Chat User.
     * @param string $messagingBindingAddress The address of the participant's
     *                                        device.
     * @param string $messagingBindingProxyAddress The address of the Twilio phone
     *                                             number that the participant is
     *                                             in contact with.
     * @param \DateTime $dateCreated The date that this resource was created.
     * @param \DateTime $dateUpdated The date that this resource was last updated.
     * @param string $attributes An optional string metadata field you can use to
     *                           store any data you wish.
     * @param string $messagingBindingProjectedAddress The address of the Twilio
     *                                                 phone number that is used in
     *                                                 Group MMS.
     */
    public function __construct($identity = Values::NONE, $messagingBindingAddress = Values::NONE, $messagingBindingProxyAddress = Values::NONE, $dateCreated = Values::NONE, $dateUpdated = Values::NONE, $attributes = Values::NONE, $messagingBindingProjectedAddress = Values::NONE) {
        $this->options['identity'] = $identity;
        $this->options['messagingBindingAddress'] = $messagingBindingAddress;
        $this->options['messagingBindingProxyAddress'] = $messagingBindingProxyAddress;
        $this->options['dateCreated'] = $dateCreated;
        $this->options['dateUpdated'] = $dateUpdated;
        $this->options['attributes'] = $attributes;
        $this->options['messagingBindingProjectedAddress'] = $messagingBindingProjectedAddress;
    }

    /**
     * A unique string identifier for the conversation participant as [Chat User](https://www.twilio.com/docs/chat/rest/user-resource). This parameter is non-null if (and only if) the participant is using the Programmable Chat SDK to communicate. Limited to 256 characters.
     *
     * @param string $identity A unique string identifier for the conversation
     *                         participant as Chat User.
     * @return $this Fluent Builder
     */
    public function setIdentity($identity) {
        $this->options['identity'] = $identity;
        return $this;
    }

    /**
     * The address of the participant's device, e.g. a phone number or Messenger ID. Together with the Proxy address, this determines a participant uniquely. This field (with proxy_address) is only null when the participant is interacting from a Chat endpoint (see the 'identity' field).
     *
     * @param string $messagingBindingAddress The address of the participant's
     *                                        device.
     * @return $this Fluent Builder
     */
    public function setMessagingBindingAddress($messagingBindingAddress) {
        $this->options['messagingBindingAddress'] = $messagingBindingAddress;
        return $this;
    }

    /**
     * The address of the Twilio phone number (or WhatsApp number, or Messenger Page ID) that the participant is in contact with. This field, together with participant address, is only null when the participant is interacting from a Chat endpoint (see the 'identity' field).
     *
     * @param string $messagingBindingProxyAddress The address of the Twilio phone
     *                                             number that the participant is
     *                                             in contact with.
     * @return $this Fluent Builder
     */
    public function setMessagingBindingProxyAddress($messagingBindingProxyAddress) {
        $this->options['messagingBindingProxyAddress'] = $messagingBindingProxyAddress;
        return $this;
    }

    /**
     * The date that this resource was created.
     *
     * @param \DateTime $dateCreated The date that this resource was created.
     * @return $this Fluent Builder
     */
    public function setDateCreated($dateCreated) {
        $this->options['dateCreated'] = $dateCreated;
        return $this;
    }

    /**
     * The date that this resource was last updated.
     *
     * @param \DateTime $dateUpdated The date that this resource was last updated.
     * @return $this Fluent Builder
     */
    public function setDateUpdated($dateUpdated) {
        $this->options['dateUpdated'] = $dateUpdated;
        return $this;
    }

    /**
     * An optional string metadata field you can use to store any data you wish. The string value must contain structurally valid JSON if specified.  **Note** that if the attributes are not set "{}" will be returned.
     *
     * @param string $attributes An optional string metadata field you can use to
     *                           store any data you wish.
     * @return $this Fluent Builder
     */
    public function setAttributes($attributes) {
        $this->options['attributes'] = $attributes;
        return $this;
    }

    /**
     * The address of the Twilio phone number that is used in Group MMS. Communication mask for the Chat participant with Identity.
     *
     * @param string $messagingBindingProjectedAddress The address of the Twilio
     *                                                 phone number that is used in
     *                                                 Group MMS.
     * @return $this Fluent Builder
     */
    public function setMessagingBindingProjectedAddress($messagingBindingProjectedAddress) {
        $this->options['messagingBindingProjectedAddress'] = $messagingBindingProjectedAddress;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() {
        $options = array();
        foreach ($this->options as $key => $value) {
            if ($value != Values::NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Conversations.V1.CreateParticipantOptions ' . \implode(' ', $options) . ']';
    }
}

class UpdateParticipantOptions extends Options {
    /**
     * @param \DateTime $dateCreated The date that this resource was created.
     * @param \DateTime $dateUpdated The date that this resource was last updated.
     * @param string $attributes An optional string metadata field you can use to
     *                           store any data you wish.
     */
    public function __construct($dateCreated = Values::NONE, $dateUpdated = Values::NONE, $attributes = Values::NONE) {
        $this->options['dateCreated'] = $dateCreated;
        $this->options['dateUpdated'] = $dateUpdated;
        $this->options['attributes'] = $attributes;
    }

    /**
     * The date that this resource was created.
     *
     * @param \DateTime $dateCreated The date that this resource was created.
     * @return $this Fluent Builder
     */
    public function setDateCreated($dateCreated) {
        $this->options['dateCreated'] = $dateCreated;
        return $this;
    }

    /**
     * The date that this resource was last updated.
     *
     * @param \DateTime $dateUpdated The date that this resource was last updated.
     * @return $this Fluent Builder
     */
    public function setDateUpdated($dateUpdated) {
        $this->options['dateUpdated'] = $dateUpdated;
        return $this;
    }

    /**
     * An optional string metadata field you can use to store any data you wish. The string value must contain structurally valid JSON if specified.  **Note** that if the attributes are not set "{}" will be returned.
     *
     * @param string $attributes An optional string metadata field you can use to
     *                           store any data you wish.
     * @return $this Fluent Builder
     */
    public function setAttributes($attributes) {
        $this->options['attributes'] = $attributes;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() {
        $options = array();
        foreach ($this->options as $key => $value) {
            if ($value != Values::NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Conversations.V1.UpdateParticipantOptions ' . \implode(' ', $options) . ']';
    }
}