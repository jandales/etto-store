import { h } from 'vue'

const List = (props, context) => {
    return h('li', context.attrs, context.slots)
}

export default List
