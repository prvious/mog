import { computePosition, autoUpdate, flip, offset, shift, arrow, hide } from '@floating-ui/dom'

let transformOrigin = (options) => ({
    name: 'transformOrigin',
    options,
    fn(data) {
        const { placement, rects, middlewareData } = data
        const cannotCenterArrow = middlewareData.arrow?.centerOffset !== 0
        const isArrowHidden = cannotCenterArrow
        const arrowWidth = isArrowHidden ? 0 : options.arrowWidth
        const arrowHeight = isArrowHidden ? 0 : options.arrowHeight

        const [placedSide, placedAlign = 'center'] = placement.split('-')
        const noArrowAlign = { start: '0%', center: '50%', end: '100%' }[placedAlign]

        const arrowXCenter = (middlewareData.arrow?.x ?? 0) + arrowWidth / 2
        const arrowYCenter = (middlewareData.arrow?.y ?? 0) + arrowHeight / 2

        let x = ''
        let y = ''

        if (placedSide === 'bottom') {
            x = isArrowHidden ? noArrowAlign : `${arrowXCenter}px`
            y = `${-arrowHeight}px`
        } else if (placedSide === 'top') {
            x = isArrowHidden ? noArrowAlign : `${arrowXCenter}px`
            y = `${rects.floating.height + arrowHeight}px`
        } else if (placedSide === 'right') {
            x = `${-arrowHeight}px`
            y = isArrowHidden ? noArrowAlign : `${arrowYCenter}px`
        } else if (placedSide === 'left') {
            x = `${rects.floating.width + arrowHeight}px`
            y = isArrowHidden ? noArrowAlign : `${arrowYCenter}px`
        }
        return { data: { x, y } }
    },
})

let OPPOSITE_SIDE = {
    top: 'bottom',
    right: 'left',
    bottom: 'top',
    left: 'right',
}

export default function (Alpine) {
    Alpine.magic('tooltip', (el) => {
        if (!el._x_tooltip) throw 'Alpine: No x-tooltip directive found on element using $tooltip...'

        return el._x_tooltip
    })

    Alpine.interceptClone((from, to) => {
        if (from && from._x_tooltip && !to._x_tooltip) {
            to._x_tooltip = from._x_tooltip
        }
    })

    Alpine.directive(
        'tooltip',
        Alpine.skipDuringClone(
            (el, { expression, modifiers, value }, { cleanup, evaluate }) => {
                let { placement, offsetValue, unstyled } = getOptions(modifiers)

                el._x_tooltip = Alpine.reactive({ x: 0, y: 0 })

                let reference = evaluate(expression)

                if (!reference) throw 'Alpine: no element provided to x-tooltip...'

                let arrowEl = el.querySelector('[data-slot="tooltip-arrow"]')

                let transformOriginStyle = {
                    top: '',
                    right: '0 0',
                    bottom: 'center 0',
                    left: '100% 0',
                }

                let transformStyle = {
                    top: 'translateY(100%)',
                    right: 'translateY(50%) rotate(90deg) translateX(-50%)',
                    bottom: `rotate(180deg)`,
                    left: 'translateY(50%) rotate(-90deg) translateX(50%)',
                }

                let compute = () => {
                    let previousValue
                    let collisionPaddingProp = 5

                    const collisionPadding =
                        typeof collisionPaddingProp === 'number' ? collisionPaddingProp : { top: 0, right: 0, bottom: 0, left: 0, ...collisionPaddingProp }

                    const boundary = []
                    const hasExplicitBoundaries = boundary.length > 0

                    const detectOverflowOptions = {
                        padding: collisionPadding,
                        boundary: boundary.filter((x) => x !== null),
                        // with `strategy: 'fixed'`, this is the only way to get it to respect boundaries
                        altBoundary: hasExplicitBoundaries,
                    }

                    computePosition(reference, el, {
                        strategy: 'fixed',
                        placement,
                        middleware: [
                            offset(offsetValue),
                            shift({ padding: 5 }),
                            flip({ ...detectOverflowOptions }),
                            arrow({ element: arrowEl, padding: offsetValue }),
                            transformOrigin({ arrowWidth: arrowEl.offsetWidth, arrowHeight: arrowEl.offsetHeight }),
                            hide({ strategy: 'referenceHidden', ...detectOverflowOptions }),
                        ],
                    }).then(({ x, y, placement: finalPlacement, middlewareData }) => {
                        let arrowData = { arrowX: middlewareData.arrow?.x, arrowY: -arrowEl.offsetHeight / 2 }

                        unstyled || setStyles(el, x, y, arrowData.arrowX, arrowData.arrowY)

                        // Only trigger Alpine reactivity when the value actually changes...
                        if (JSON.stringify({ x, y, ...arrowData }) !== previousValue) {
                            el._x_tooltip.x = x
                            el._x_tooltip.y = y
                            el._x_tooltip.arrowX = arrowData.arrowX
                            el._x_tooltip.arrowY = arrowData.arrowY
                            let [side, align] = finalPlacement.split('-')

                            arrowEl.style[OPPOSITE_SIDE[side]] = 0
                            arrowEl.style.position = 'absolute'
                            // arrowEl.style.zIndex = 49
                            arrowEl.style.transformOrigin = transformOriginStyle[side]
                            arrowEl.style.transform = transformStyle[side]
                        }

                        previousValue = JSON.stringify({ x, y, ...arrowData })
                    })
                }

                let release = autoUpdate(reference, el, () => compute())

                cleanup(() => release())
            },

            // When cloning (or "morphing"), we will graft the style and position data from the live tree...
            (el, { expression, modifiers, value }, { cleanup, evaluate }) => {
                let { placement, offsetValue, unstyled } = getOptions(modifiers)

                if (el._x_tooltip) {
                    unstyled || setStyles(el, el._x_tooltip.x, el._x_tooltip.y, el._x_tooltip.arrowX, el._x_tooltip.arrowY)
                }
            },
        ),
    )
}

function setStyles(el, x, y, arrowX, arrowY) {
    Object.assign(el.style, {
        left: x + 'px',
        top: y + 'px',
        position: 'absolute',
    })

    Object.assign(el.querySelector('[data-slot="tooltip-arrow"]').style, {
        left: arrowX + 'px',
        top: arrowY + 'px',
    })
}

function getOptions(modifiers) {
    let alignments = ['start', 'center', 'end']
    let positions = ['top', 'right', 'bottom', 'left'].map((i) => alignments.map((j) => `${i}-${j}`)).reduce((a, b) => a.concat(b), [])
    let placement = positions.find((i) => modifiers.includes(i))
    let offsetValue = 0
    if (modifiers.includes('offset')) {
        let idx = modifiers.findIndex((i) => i === 'offset')

        offsetValue = modifiers[idx + 1] !== undefined ? Number(modifiers[idx + 1]) : offsetValue
    }
    let unstyled = modifiers.includes('no-style')

    return { placement, offsetValue, unstyled }
}
