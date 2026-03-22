<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    /**
     * MATERIAL ATTRIBUTES
     * $this->attributes['id'] - int - contains the material primary key
     * $this->attributes['name'] - string - contains the material name
     * $this->attributes['type'] - string - contains the material type
     * $this->attributes['description'] - string - contains the material description
     * $this->attributes['color'] - string - contains the material color
     * $this->attributes['created_at'] - datetime - contains the creation date
     * $this->attributes['updated_at'] - datetime - contains the update date
     */

    protected $fillable = ['name', 'type', 'description', 'color'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // GETTERS
    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function getType(): string
    {
        return $this->attributes['type'];
    }

    public function getDescription(): string
    {
        return $this->attributes['description'];
    }

    public function getColor(): string
    {
        return $this->attributes['color'];
    }

    // SETTERS
    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    public function setType(string $type): void
    {
        $this->attributes['type'] = $type;
    }

    public function setDescription(string $description): void
    {
        $this->attributes['description'] = $description;
    }

    public function setColor(string $color): void
    {
        $this->attributes['color'] = $color;
    }
}