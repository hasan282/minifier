<?php

namespace Tests\Unit;

use Hasan282\Minifier\Helper\Minify;
use PHPUnit\Framework\TestCase;

class MinifyTest extends TestCase
{
    public function testMinifyHtml()
    {
        $input = "  <html> \n \n  <body>  <p>Test</p> <!-- html comment --> <div>Text inside   \n   div</div>  \n  </body> </html>     ";
        $expectedOutput = "<html><body><p>Test</p><div>Text inside div</div></body></html>";

        $output = Minify::html($input);

        $this->assertEquals($expectedOutput, $output);
    }

    public function testMinifyScript()
    {
        $input = "<html><body><script> \n // This is a comment \n    console.log('Hello'); /* Another comment */  \n\n  funct1(); </script><p>Test</p><div>Text inside div</div><script type='js'>  // log file 2 \n\n  console.log('LOG2');   </script></body></html>";
        $expectedOutput = "<html><body><script>console.log('Hello');funct1();</script><p>Test</p><div>Text inside div</div><script type='js'>console.log('LOG2');</script></body></html>";

        $output = Minify::script($input);

        $this->assertEquals($expectedOutput, $output);
    }
}
