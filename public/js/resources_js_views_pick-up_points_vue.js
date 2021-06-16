(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_views_pick-up_points_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/tables/pick-up_points_table.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/tables/pick-up_points_table.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: "pick-up_points_table",
  props: ["pickup_points"]
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/pick-up_points.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/pick-up_points.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _components_tables_pick_up_points_table__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../components/tables/pick-up_points_table */ "./resources/js/components/tables/pick-up_points_table.vue");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: "pick-up_points",
  components: {
    pickup_points_table: _components_tables_pick_up_points_table__WEBPACK_IMPORTED_MODULE_0__.default
  },
  metaInfo: function metaInfo() {
    return {
      title: this.$title('Pickup Points')
    };
  },
  data: function data() {
    return {
      page: +this.$route.query.page || 1,
      res: {},
      loading: true,
      class_name: "pickup_points",
      code: ''
    };
  },
  computed: {
    pickup_points: function pickup_points() {
      return this.$store.getters.pickup_points;
    },
    pageSize: function pageSize() {
      return this.res.meta.per_page;
    },
    pageCount: function pageCount() {
      return this.res.meta.last_page;
    }
  },
  mounted: function mounted() {
    var _this = this;

    this.$store.dispatch('fetch_pickup_points').then(function (res) {
      _this.loading = false;
      _this.res = res;
    });
    console.log(this.pickup_points);
  },
  methods: {
    pageChangeHandler: function pageChangeHandler(page) {
      var _this2 = this;

      this.loading = true;
      this.$router.push("".concat(this.$route.path, "?page=").concat(page));
      this.$store.dispatch("fetch_".concat(this.class_name), page).then(function () {
        _this2.loading = false;
      });
    }
  }
});

/***/ }),

/***/ "./resources/js/components/tables/pick-up_points_table.vue":
/*!*****************************************************************!*\
  !*** ./resources/js/components/tables/pick-up_points_table.vue ***!
  \*****************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _pick_up_points_table_vue_vue_type_template_id_f12af14e_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./pick-up_points_table.vue?vue&type=template&id=f12af14e&scoped=true& */ "./resources/js/components/tables/pick-up_points_table.vue?vue&type=template&id=f12af14e&scoped=true&");
/* harmony import */ var _pick_up_points_table_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./pick-up_points_table.vue?vue&type=script&lang=js& */ "./resources/js/components/tables/pick-up_points_table.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__.default)(
  _pick_up_points_table_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__.default,
  _pick_up_points_table_vue_vue_type_template_id_f12af14e_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render,
  _pick_up_points_table_vue_vue_type_template_id_f12af14e_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  "f12af14e",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/tables/pick-up_points_table.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/views/pick-up_points.vue":
/*!***********************************************!*\
  !*** ./resources/js/views/pick-up_points.vue ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _pick_up_points_vue_vue_type_template_id_5954459a_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./pick-up_points.vue?vue&type=template&id=5954459a&scoped=true& */ "./resources/js/views/pick-up_points.vue?vue&type=template&id=5954459a&scoped=true&");
/* harmony import */ var _pick_up_points_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./pick-up_points.vue?vue&type=script&lang=js& */ "./resources/js/views/pick-up_points.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__.default)(
  _pick_up_points_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__.default,
  _pick_up_points_vue_vue_type_template_id_5954459a_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render,
  _pick_up_points_vue_vue_type_template_id_5954459a_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  "5954459a",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/pick-up_points.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/components/tables/pick-up_points_table.vue?vue&type=script&lang=js&":
/*!******************************************************************************************!*\
  !*** ./resources/js/components/tables/pick-up_points_table.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_pick_up_points_table_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./pick-up_points_table.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/tables/pick-up_points_table.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_pick_up_points_table_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__.default); 

/***/ }),

/***/ "./resources/js/views/pick-up_points.vue?vue&type=script&lang=js&":
/*!************************************************************************!*\
  !*** ./resources/js/views/pick-up_points.vue?vue&type=script&lang=js& ***!
  \************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_pick_up_points_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./pick-up_points.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/pick-up_points.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_pick_up_points_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__.default); 

/***/ }),

/***/ "./resources/js/components/tables/pick-up_points_table.vue?vue&type=template&id=f12af14e&scoped=true&":
/*!************************************************************************************************************!*\
  !*** ./resources/js/components/tables/pick-up_points_table.vue?vue&type=template&id=f12af14e&scoped=true& ***!
  \************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_pick_up_points_table_vue_vue_type_template_id_f12af14e_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_pick_up_points_table_vue_vue_type_template_id_f12af14e_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_pick_up_points_table_vue_vue_type_template_id_f12af14e_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./pick-up_points_table.vue?vue&type=template&id=f12af14e&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/tables/pick-up_points_table.vue?vue&type=template&id=f12af14e&scoped=true&");


/***/ }),

/***/ "./resources/js/views/pick-up_points.vue?vue&type=template&id=5954459a&scoped=true&":
/*!******************************************************************************************!*\
  !*** ./resources/js/views/pick-up_points.vue?vue&type=template&id=5954459a&scoped=true& ***!
  \******************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_pick_up_points_vue_vue_type_template_id_5954459a_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_pick_up_points_vue_vue_type_template_id_5954459a_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_pick_up_points_vue_vue_type_template_id_5954459a_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./pick-up_points.vue?vue&type=template&id=5954459a&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/pick-up_points.vue?vue&type=template&id=5954459a&scoped=true&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/tables/pick-up_points_table.vue?vue&type=template&id=f12af14e&scoped=true&":
/*!***************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/components/tables/pick-up_points_table.vue?vue&type=template&id=f12af14e&scoped=true& ***!
  \***************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("table", { staticClass: "striped" }, [
    _vm._m(0),
    _vm._v(" "),
    _c(
      "tbody",
      _vm._l(_vm.pickup_points, function(pickup_point, index) {
        return _c("tr", { key: pickup_point.address }, [
          _c("td", [_vm._v(_vm._s(index + 1))]),
          _vm._v(" "),
          _c("td", [_vm._v(_vm._s(pickup_point.address))]),
          _vm._v(" "),
          _c("td", [_vm._v(_vm._s(pickup_point.hours))])
        ])
      }),
      0
    )
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("thead", [
      _c("tr", [
        _c("th"),
        _vm._v(" "),
        _c("th", [_vm._v("Адрес")]),
        _vm._v(" "),
        _c("th", [_vm._v("Часы работы")]),
        _vm._v(" "),
        _c("th"),
        _vm._v(" "),
        _c("th")
      ])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/pick-up_points.vue?vue&type=template&id=5954459a&scoped=true&":
/*!*********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/pick-up_points.vue?vue&type=template&id=5954459a&scoped=true& ***!
  \*********************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _vm.loading
        ? _c("Loader")
        : !_vm.pickup_points.length
        ? _c("p", { staticClass: "center" }, [
            _vm._v("\n    " + _vm._s(_vm._f("localize")("NoRecords")) + "\n  ")
          ])
        : _c(
            "div",
            [
              _c("pickup_points_table", {
                attrs: { pickup_points: _vm.pickup_points }
              }),
              _vm._v(" "),
              _c("Paginate", {
                attrs: {
                  "page-count": _vm.pageCount,
                  "margin-pages": 2,
                  "click-handler": _vm.pageChangeHandler,
                  "prev-text": "&laquo;",
                  "next-text": "&raquo;",
                  "container-class": "pagination",
                  "page-class": "waves-effect",
                  "active-class": "indigo lighten-4"
                },
                model: {
                  value: _vm.page,
                  callback: function($$v) {
                    _vm.page = $$v
                  },
                  expression: "page"
                }
              })
            ],
            1
          )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ })

}]);