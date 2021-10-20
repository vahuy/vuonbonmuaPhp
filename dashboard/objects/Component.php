<?php
/**
 * Created by PhpStorm.
 * User: vahuy
 * Date: 1/16/2019
 * Time: 3:13 PM
 */

class Component {
    public function renderButton($value, $name, $type, $disabled) {
        $isDisabled = null;
        if ($disabled === true || $disabled === 'disabled') {
            $isDisabled = 'disabled';
        }
        return "
            <button type='$type' name='$name' $isDisabled>$value</button>
        ";
    }

    public function renderOption( $name, $disabled, $optionValues, $optionNames) {
        $isDisabled = null;
        $numOfValues = count($optionValues);
        $numOfNames = count($optionNames);
        if ($disabled === true || $disabled === 'disabled') {
            $isDisabled = 'disabled';
        }
        if ($numOfValues !== $numOfNames) {
            $isDisabled = null;
            echo "Miss some value or name for option";
            return false;
        } else {
            echo "<select $isDisabled name='$name'>";
            for ($i = 0; $i < $numOfValues; $i++) {
                echo "<option value='$optionValues[$i]'>$optionNames[$i]</option>";
            }
            echo "</select>";
        }
        return null;
    }

    public function renderOptionWithSelected( $name, $disabled, $optionValues, $optionNames, $selected) {
        $isDisabled = null;
        $numOfValues = count($optionValues);
        $numOfNames = count($optionNames);
        if ($disabled === true || $disabled === 'disabled') {
            $isDisabled = 'disabled';
        }
        if ($numOfValues !== $numOfNames) {
            $isDisabled = null;
            echo "Miss some value or name for option";
            return false;
        } else {
            echo "<select $isDisabled name='$name'>";
            for ($i = 0; $i < $numOfValues; $i++) {
                if($optionValues[$i]===$selected) {
                    echo "<option value='$optionValues[$i]' selected='$selected'>$optionNames[$i]</option>";
                } else {
                    echo "<option value='$optionValues[$i]'>$optionNames[$i]</option>";
                }
            }
            echo "</select>";
        }
        return null;
    }

    public function getValueFromBoolean($boolean) {
        return $boolean === true ? 'YES' : 'NO';
    }
}