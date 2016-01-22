<?php
/**
 * Fontis BPAY Ref Generator
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   Fontis
 * @package    Fontis_BpayRefGenerator
 * @copyright  Copyright (c) 2016 Fontis Pty. Ltd. (https://www.fontis.com.au)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Fontis\BpayRefGenerator;

class Generator
{
    /**
     * Calculate Modulus 10 Version 1.
     *
     * @param string $number
     * @param string $separator
     * @param int $minimumLength
     * @return string
     */
    public function calcMod10V1($number, $separator = "", $minimumLength = 6)
    {
        // TODO: Remove manual cast when we no longer support PHP5
        $number = (string) $number;

        $revstr = strrev(intval($number));
        $revstrLen = strlen($revstr);
        $total = 0;
        for ($i = 0; $i < $revstrLen; $i++) {
            if ($i % 2 == 0) {
                $multiplier = 2;
            } else {
                $multiplier = 1;
            }

            $subtotal = intval($revstr[$i]) * $multiplier;
            if ($subtotal >= 10) {
                $temp = (string) $subtotal;
                $subtotal = intval($temp[0]) + intval($temp[1]);
            }
            $total += $subtotal;
        }

        $checkDigit = (10 - ($total % 10)) % 10;
        $crn = str_pad(ltrim($number, "0"), $minimumLength - 1, "0", STR_PAD_LEFT) . $separator . $checkDigit;

        return $crn;
    }

    /**
     * Calculate Modulus 10 Version 5.
     *
     * @see http://stackoverflow.com/a/11605561/747834
     *
     * @param string $number
     * @return string
     */
    public function calcMod10V5($number)
    {
        // TODO: Remove manual cast when we no longer support PHP5
        $number = (string) $number;

        // Get the length of the seed number
        $length = strlen($number);

        $total = 0;

        // For each character in seed number, sum the character multiplied by its one
        // based array position (instead of normal PHP zero based numbering)
        for ($i = 0; $i < $length; $i++) {
            $total += $number{$i} * ($i + 1);
        }

        // The check digit is the result of the sum total from above mod 10
        $checkDigit = fmod($total, 10);

        // Return the original seed plus the check digit
        return $number . $checkDigit;
    }
}
