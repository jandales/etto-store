import { h } from 'vue'


const TextContent = (props, context) => {
  return h(props.type, context.attrs, context.slots)
}

export default TextContent
