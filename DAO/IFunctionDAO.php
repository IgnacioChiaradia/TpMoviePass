<?php
    namespace DAO;

    use Models\Function as Function;

    interface IFunctionDAO
    {
        function Add(Function $function);
        function Update(Function $function);
    }
?>