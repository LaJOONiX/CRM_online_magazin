(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_views_receipts_code_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/receipts_code.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/receipts_code.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************************************************************/
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
  name: "Receipts_code",
  metaInfo: function metaInfo() {
    return {
      title: this.$title("show_receipt")
    };
  },
  data: function data() {
    return {
      receipt: null,
      loading: true
    };
  },
  mounted: function mounted() {
    var _this = this;

    var code = this.$route.params.code;
    this.$store.dispatch('fetch_receipt', code).then(function (res) {
      _this.receipt = res;
      _this.loading = false;
    });
  }
});

/***/ }),

/***/ "./resources/js/views/receipts_code.vue":
/*!**********************************************!*\
  !*** ./resources/js/views/receipts_code.vue ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _receipts_code_vue_vue_type_template_id_78d3fb82_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./receipts_code.vue?vue&type=template&id=78d3fb82&scoped=true& */ "./resources/js/views/receipts_code.vue?vue&type=template&id=78d3fb82&scoped=true&");
/* harmony import */ var _receipts_code_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./receipts_code.vue?vue&type=script&lang=js& */ "./resources/js/views/receipts_code.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__.default)(
  _receipts_code_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__.default,
  _receipts_code_vue_vue_type_template_id_78d3fb82_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render,
  _receipts_code_vue_vue_type_template_id_78d3fb82_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  "78d3fb82",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/receipts_code.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/views/receipts_code.vue?vue&type=script&lang=js&":
/*!***********************************************************************!*\
  !*** ./resources/js/views/receipts_code.vue?vue&type=script&lang=js& ***!
  \***********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_receipts_code_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./receipts_code.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/receipts_code.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_receipts_code_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__.default); 

/***/ }),

/***/ "./resources/js/views/receipts_code.vue?vue&type=template&id=78d3fb82&scoped=true&":
/*!*****************************************************************************************!*\
  !*** ./resources/js/views/receipts_code.vue?vue&type=template&id=78d3fb82&scoped=true& ***!
  \*****************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_receipts_code_vue_vue_type_template_id_78d3fb82_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_receipts_code_vue_vue_type_template_id_78d3fb82_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_receipts_code_vue_vue_type_template_id_78d3fb82_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./receipts_code.vue?vue&type=template&id=78d3fb82&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/receipts_code.vue?vue&type=template&id=78d3fb82&scoped=true&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/receipts_code.vue?vue&type=template&id=78d3fb82&scoped=true&":
/*!********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/views/receipts_code.vue?vue&type=template&id=78d3fb82&scoped=true& ***!
  \********************************************************************************************************************************************************************************************************************************/
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
        : _vm.receipt
        ? _c("div", [
            _c(
              "div",
              { staticClass: "breadcrumb-wrap" },
              [
                _c(
                  "router-link",
                  { staticClass: "breadcrumb", attrs: { to: "/" } },
                  [_vm._v(_vm._s(_vm._f("localize")("Menu_Receipts")))]
                ),
                _vm._v(" "),
                _c(
                  "a",
                  {
                    staticClass: "breadcrumb",
                    on: {
                      click: function($event) {
                        $event.preventDefault()
                      }
                    }
                  },
                  [_vm._v(_vm._s(_vm.receipt.code))]
                )
              ],
              1
            ),
            _vm._v(" "),
            _c("div", { staticClass: "row" }, [
              _c("div", { staticClass: "col s12 m6" }, [
                _c(
                  "div",
                  {
                    staticClass: "card",
                    staticStyle: {
                      background: "#EDF8F3",
                      "box-shadow":
                        "0px 0px 4px rgba(0, 0, 0, 0.15), 0px 0px 4px rgba(0, 0, 0, 0.1)",
                      color: "black"
                    }
                  },
                  [
                    _c("div", { staticClass: "card-content" }, [
                      _c("span", { staticClass: "card-title" }, [
                        _vm._v(
                          "Подробный просмотр квитанции " +
                            _vm._s(_vm.receipt.code)
                        )
                      ]),
                      _vm._v(" "),
                      _c("div", [_vm._v(_vm._s(_vm.receipt.created_at))]),
                      _vm._v(" "),
                      _c("div", [_vm._v(_vm._s(_vm.receipt.payment_code))]),
                      _vm._v(" "),
                      _c("div", [
                        _vm._v(
                          "-------------------------------------------------------------"
                        )
                      ]),
                      _vm._v(" "),
                      _c(
                        "div",
                        [
                          _c(
                            "span",
                            {
                              staticStyle: {
                                display: "inline-block",
                                padding: "2px 10px",
                                "border-radius": "8px",
                                border: "1px solid #431321"
                              }
                            },
                            [_vm._v("Подписки")]
                          ),
                          _vm._v(" "),
                          _vm._l(_vm.receipt.subscriptions, function(
                            subscription,
                            index
                          ) {
                            return _c("div", [
                              _c("div", [
                                _vm._v(
                                  "Код подписки: " + _vm._s(subscription.code)
                                )
                              ]),
                              _vm._v(" "),
                              _c("div", [
                                _vm._v(
                                  "Количество изданий: " +
                                    _vm._s(subscription.count)
                                )
                              ]),
                              _vm._v(" "),
                              _c("div", [
                                _vm._v(
                                  "Название издания: " +
                                    _vm._s(subscription.publication.title)
                                )
                              ]),
                              _vm._v(" "),
                              _c("div", [
                                _vm._v(
                                  "Когда создано: " +
                                    _vm._s(subscription.created_at)
                                )
                              ]),
                              _vm._v(" "),
                              _c("div", [
                                _vm._v(
                                  "-------------------------------------------------------------"
                                )
                              ])
                            ])
                          })
                        ],
                        2
                      )
                    ])
                  ]
                )
              ])
            ])
          ])
        : _c("p", { staticClass: "center" }, [
            _vm._v(
              "Запись с id = " + _vm._s(_vm.$route.params.id) + " не найдена"
            )
          ])
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ })

}]);