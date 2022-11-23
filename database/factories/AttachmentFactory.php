<?php


class AttachmentFactory extends \Illuminate\Database\Eloquent\Factories\Factory{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */

    public function definition()
    {

        return [
            'uuid' => $this->faker->uuid,
            'url' => ''//$faker->file(storage_path('app/private/attachments'), public_path('storage/attachments'), false),
        ];
    }
}
