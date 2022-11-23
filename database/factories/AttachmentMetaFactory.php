<?php

class AttachmentMetaFactory extends \Illuminate\Database\Eloquent\Factories\Factory{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */

    public function definition()
    {
        $data = [];
        $data['ext'] = $this->faker->fileExtension;
        $data['mime-type'] = $this->faker->mimeType;
        $data['size'] = (round($this->faker->numberBetween(500000, 10000000) / 1e+6,  2) ). ' Megabytes';

        return [
            "metadata" => $data
        ];


    }
}
