froodTwig Frood extension
=========================

*Authors* [Jens Riisom Schultz](mailto:ibber_of_crew42@hotmail.com), [Bo Thinggaard](akimsko@tnactas.dk)
*Since*   2011-12-19

FroodTwig is a Twig template engine extension for [The Frood VC framework](https://github.com/Ibmurai/frood).


Documentation
-------------

  * Template files should end with `.html.twig`.
  * `extends` use references of the form `[subModule]/[controller]/[action].html.twig`, i.e. `public/index/index.html.twig`.
  * To extend the original template prefix the reference with `original:`, i.e. `original:public/index/index.html.twig`.
  * To extend a template refererenced from the root of the theme folder, use the prefix `theme:`.
  * To enable support for the prefixes and template overloading you will need to set the theme path by calling `FroodRendererTwig::setThemePath()`. _Zaphod will do this for you_.


Installing
----------

  * Run `install.php` from command line.
  * Prosper.


License
-------

Copyright 2011 Jens Riisom Schultz

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
