<?php

declare(strict_types=1);

namespace PhpArrayVsObjectBenchmark\Core;

const CASE_CREATE = 'CREATE';
const CASE_GET = 'GET';
const CASE_GET_1 = 'foreach element';
const CASE_GET_2 = 'foreach element; by single class getter';
const CASE_GET_3 = 'foreach element; by multi class getter';
const CASE_GET_4 = 'foreach element; by single trait getter';
const CASE_GET_5 = 'foreach element; by multi trait getter';
const CASE_GET_6 = 'foreach key => element; by element';
const CASE_GET_7 = 'foreach key => element; by key';
const CASE_GET_8 = 'foreach array_keys; by key';
const CASE_GET_T2_1 = 'every element';
const CASE_SET = 'SET';
const CASE_SET_1 = 'foreach key => element; by key';
const CASE_SET_2 = 'foreach key => &element; by reference';
const CASE_SET_3 = 'array_map';
const CASE_SET_4 = 'array_walk';
const CASE_SET_T2_1 = 'every element by callback (1)';
const CASE_SET_T2_2 = 'every element by callback (2)';
