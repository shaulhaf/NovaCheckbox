<template>
    <default-field :field="field" :errors="errors" v-if="!hidden">
        <template slot="field">
            <div class="cp_input_wrap">
                <input type="checkbox" :id="field.attribute" class="custom_toggle" v-model="value" disabled v-if="field.disabled">
                <input type="checkbox" :id="field.attribute" class="custom_toggle" v-model="value" v-else>
                <label :for="field.attribute" class="filter_option_cb">
                    <div class="filter_option_cb_inner"></div>
                </label>
            </div>
        </template>
    </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    data() {
        return {
            hidden: false,
        }
    },
    mounted() {
        if (this.field.hidden) {
            this.hidden = true;
        }
    },
    methods: {
        setInitialValue() {
            this.value = this.field.value || ''
        },

        fill(formData) {
            formData.append(this.field.attribute, this.trueValue || '')
        },

        handleChange(value) {
            this.value = value
        },
    },
    computed: {
        checked() {
            return Boolean(this.value)
        },

        trueValue() {
            return +this.checked
        },
    },

  watch: {
    value: {
      deep: true,
      handler(value) {
        this.$emit('changed', value)
      }
    }
  },
}
</script>
<style>
.custom_toggle {
    display: none;
}

.filter_option_cb {
    width: 57px;
    height: 27px;
    border-radius: 30px;
    background: #aaa;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    padding: 0 4px;
    cursor: pointer;
}

.filter_option_cb_inner {
    width: 20px;
    height: 20px;
    background: #fff;
    border-radius: 30px;
}

.custom_toggle:checked + .filter_option_cb {
    background: #52BF5F;
    justify-content: flex-end;
}

</style>
