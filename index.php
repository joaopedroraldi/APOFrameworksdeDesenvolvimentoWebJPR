<?php

// Porta de entrada do site.
// Ela só chama o index.php que fica dentro da pasta public.
// Fizemos assim porque o site roda dentro de uma subpasta da hospedagem.
require __DIR__.'/public/index.php';
