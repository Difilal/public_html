<?php

use PHPUnit\Framework\TestCase;

final class GlobalFunctionsTest extends TestCase
{
    public function testFilterDecimalConvertsLocalizedNumber(): void
    {
        $this->assertSame('1234.56', FilterDecimal('1.234,56'));
    }

    public function testFormatNoHPNormalizesIndonesianMobileNumber(): void
    {
        $this->assertSame('628123456789', FormatNoHP('0812-3456-789'));
        $this->assertSame('08123456789', FormatNoHP('628123456789', '0'));
    }

    public function testFormatTglSupportsLocalizedDisplay(): void
    {
        $this->assertSame('15 April 2026', FormatTgl('2026-04-15', 'full-id'));
        $this->assertSame('04/2026', FormatTgl('2026-04', '/'));
    }

    public function testLabelDataWilayahRemovesAdministrativePrefix(): void
    {
        $this->assertSame('Jakarta Barat', LabelDataWilayah('kota jakarta barat'));
        $this->assertSame('Kab. Bandung', LabelDataWilayah('kab. bandung', ['clearKota' => false]));
    }

    public function testSanitizeStringBuildsSlugWithIdentifier(): void
    {
        $this->assertSame('hello-world-99', sanitizeString('Hello, World!', 99));
    }

    public function testUtcOffsetValidationAcceptsKnownFormats(): void
    {
        $this->assertTrue(isValidUtcOffsetFormat('+07:00'));
        $this->assertTrue(isValidUtcOffsetFormat('+05:30'));
        $this->assertFalse(isValidUtcOffsetFormat('+15:00'));
        $this->assertFalse(isValidUtcOffsetFormat('07:00'));
    }

    public function testSetTglUTCShiftsDatetimeAcrossOffsets(): void
    {
        $this->assertSame(
            '2026-04-15 05:00:00',
            setTglUTC('2026-04-15 12:00:00', '+07:00', '+00:00')
        );

        $this->assertSame(
            '2026-04-15 14:30:00',
            setTglUTC('2026-04-15 12:00:00', '+07:00', '+09:30')
        );
    }

    public function testJsonValidationDetectsValidAndInvalidPayloads(): void
    {
        $this->assertTrue(isJson('{"status":"ok"}'));
        $this->assertFalse(isJson('{status:ok}'));
    }
}
