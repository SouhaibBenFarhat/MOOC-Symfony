<?php

namespace Esprit\MoocBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class EspritMoocBundle extends Bundle {

    public function getParent() {
        return 'FOSUserBundle';
    }

}
