<?php namespace Netgen\Contact\Models;

use Model;

/**
 * Model
 */
class ContactForm extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'netgen_contact_form';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
