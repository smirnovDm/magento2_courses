<?php


namespace SmirnovShipping\TestAttributes\Model\Config\Source;
use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class TestAttributes extends AbstractSource
{
    public function getAllOptions()
    {
        $this->options=[
                         ['label' => 'Yes', 'value' => 1],
                         ['label' => 'No', 'value' => 0],
        ];
        return $this->options;
    }

    public function getOptionText($value)
    {
        foreach ($this->getAllOptions() as $option)
        {
            if ($option['value'] == $value) {
                return $option['label'];
            }
        }
        return false;
    }
}
