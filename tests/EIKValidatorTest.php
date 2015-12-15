<?php

use Mirovit\EIKValidator\EIKValidator;

class EIKValidatorTest extends PHPUnit_Framework_TestCase
{
    private $valid_nine_digit_eiks = ['203445228', '202322728', '835014925', '202342638'];
    private $valid_thirteen_digit_eiks = ['1213961230342'];

    /**
     * @test
     * @expectedException Mirovit\EIKValidator\Exceptions\InvalidArgument
     */
    public function it_throws_an_exception_for_non_digits()
    {
        $validator = new EIKValidator();

        $validator->isValid('12312300o');
    }

    /**
     * @test
     * @expectedException Mirovit\EIKValidator\Exceptions\InvalidLength
     */
    public function it_throws_an_exception_eik_which_has_lenght_diffrent_from_9_and_13()
    {
        $validator = new EIKValidator();

        $validator->isValid('1231231231');
    }

    /** @test */
    public function it_fails_to_validate_nine_digit_invalid_eik()
    {
        $validator = new EIKValidator();

        $eik = '000111222';

        $this->assertEquals(9, strlen($eik));
        $this->assertFalse($validator->isValid($eik));
    }

    /** @test */
    public function it_validates_nine_digit_eik()
    {
        $validator = new EIKValidator();

        foreach ($this->valid_nine_digit_eiks as $eik) {
            $this->assertEquals(9, strlen($eik));
            $this->assertTrue($validator->isValid($eik));
        }
    }

    /** @test */
    public function it_fails_to_validate_thirteen_digit_invalid_eik()
    {
        $validator = new EIKValidator();

        $eik = '0001112223333';

        $this->assertEquals(13, strlen($eik));
        $this->assertFalse($validator->isValid($eik));
    }

    /** @test */
    public function it_validates_thirteen_digit_eik()
    {
        $validator = new EIKValidator();

        foreach ($this->valid_thirteen_digit_eiks as $eik) {
            $this->assertEquals(13, strlen($eik));
            $this->assertTrue($validator->isValid($eik));
        }
    }
}
