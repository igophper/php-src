--TEST--
Observer: call_user_func() from namespace
--EXTENSIONS--
zend_test
--INI--
zend_test.observer.enabled=1
zend_test.observer.show_output=1
zend_test.observer.observe_all=1
--FILE--
<?php
namespace Test {
    final class MyClass
    {
        public static function myMethod()
        {
            echo 'MyClass::myMethod called' . PHP_EOL;
        }
    }

    function my_function()
    {
        echo 'my_function called' . PHP_EOL;
    }

    call_user_func('Test\\MyClass::myMethod');
    call_user_func('Test\\my_function');
}
?>
--EXPECTF--
<!-- init '%s' -->
<file '%s'>
  <!-- init call_user_func() -->
  <call_user_func>
    <!-- init Test\MyClass::myMethod() -->
    <Test\MyClass::myMethod>
MyClass::myMethod called
    </Test\MyClass::myMethod>
  </call_user_func>
  <call_user_func>
    <!-- init Test\my_function() -->
    <Test\my_function>
my_function called
    </Test\my_function>
  </call_user_func>
</file '%s'>
